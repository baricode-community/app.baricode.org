<?php

namespace App\Http\Controllers\Web\Academy;

use App\Http\Controllers\Controller;
use App\Models\Academy\AcademyBatch;
use App\Models\Academy\AcademyEnrollment;
use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function create(AcademyBatch $batch)
    {
        if (! $batch->is_active) {
            return back()->with('error', 'Batch ini sudah tidak aktif.');
        }

        if (! $batch->isRegistrationOpen()) {
            return back()->with('error', 'Pendaftaran untuk batch ini sudah ditutup atau penuh.');
        }

        $alreadyEnrolled = AcademyEnrollment::where('user_id', auth()->id())
            ->where('academy_batch_id', $batch->id)
            ->exists();

        if ($alreadyEnrolled) {
            return back()->with('error', 'Kamu sudah terdaftar di batch ini.');
        }

        $existingPendingOrder = Order::where('user_id', auth()->id())
            ->where('academy_batch_id', $batch->id)
            ->where('status', 'pending')
            ->first();

        if ($existingPendingOrder) {
            return view('pages.academy.payment', [
                'order' => $existingPendingOrder,
                'batch' => $batch,
                'snapToken' => $existingPendingOrder->snap_token,
                'clientKey' => config('services.midtrans.client_key'),
            ]);
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'academy_batch_id' => $batch->id,
            'amount' => $batch->price,
            'status' => 'pending',
        ]);

        $user = auth()->user();

        $snapToken = Snap::getSnapToken([
            'transaction_details' => [
                'order_id' => $order->midtransOrderId(),
                'gross_amount' => $order->amount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'item_details' => [
                [
                    'id' => 'BATCH-'.$batch->id,
                    'price' => $batch->price,
                    'quantity' => 1,
                    'name' => $batch->program->title.' - '.$batch->name,
                ],
            ],
        ]);

        $order->update(['snap_token' => $snapToken]);

        return view('pages.academy.payment', [
            'order' => $order,
            'batch' => $batch,
            'snapToken' => $snapToken,
            'clientKey' => config('services.midtrans.client_key'),
        ]);
    }

    public function notification(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash('sha512',
            $request->order_id.
            $request->status_code.
            $request->gross_amount.
            $serverKey
        );

        if ($hashed !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $orderId = str_replace('ORDER-', '', $request->order_id);
        $order = Order::where('uuid', $orderId)->firstOrFail();

        $transactionStatus = $request->transaction_status;
        $fraudStatus = $request->fraud_status ?? 'accept';

        if ($transactionStatus === 'capture' && $fraudStatus === 'accept') {
            $this->markPaid($order, $request->transaction_id);
        } elseif ($transactionStatus === 'settlement') {
            $this->markPaid($order, $request->transaction_id);
        } elseif (in_array($transactionStatus, ['deny', 'cancel', 'failure'])) {
            $order->update(['status' => 'failed']);
        } elseif ($transactionStatus === 'expire') {
            $order->update(['status' => 'expired']);
        }

        return response()->json(['message' => 'OK']);
    }

    private function markPaid(Order $order, string $transactionId): void
    {
        if ($order->isPaid()) {
            return;
        }

        $order->update([
            'status' => 'paid',
            'midtrans_transaction_id' => $transactionId,
            'paid_at' => now(),
        ]);

        AcademyEnrollment::create([
            'academy_batch_id' => $order->academy_batch_id,
            'user_id' => $order->user_id,
            'order_id' => $order->id,
            'enrolled_at' => now(),
        ]);
    }

    public function finish(Request $request)
    {
        $orderId = str_replace('ORDER-', '', $request->order_id);
        $order = Order::where('uuid', $orderId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($order->isPaid()) {
            $enrollment = $order->enrollment;

            return redirect()->route('academy.batch', $order->batch->uuid)
                ->with('success', 'Pembayaran berhasil! Selamat datang di '.$order->batch->program->title.'.');
        }

        return redirect()->route('academy.batch', $order->batch->uuid)
            ->with('info', 'Pembayaran sedang diproses. Silakan tunggu konfirmasi.');
    }
}
