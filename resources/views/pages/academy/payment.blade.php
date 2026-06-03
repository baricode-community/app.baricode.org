<x-layouts.base :title="'Pembayaran — ' . $batch->program->title">
    <div class="min-h-screen py-12 px-4 flex items-center justify-center">
        <div class="max-w-md w-full">
            <div class="bg-gray-800/60 border border-gray-700 rounded-2xl p-8 text-center">
                <div class="text-5xl mb-4">🎓</div>
                <h1 class="text-2xl font-bold text-white mb-2">Selesaikan Pembayaran</h1>
                <p class="text-gray-400 mb-2">{{ $batch->program->title }}</p>
                <p class="text-gray-500 text-sm mb-6">{{ $batch->name }}</p>

                <p class="text-4xl font-extrabold text-amber-400 mb-8">{{ $batch->formattedPrice() }}</p>

                <button id="pay-button"
                    class="w-full py-4 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 rounded-xl font-bold text-lg transition-all shadow-lg shadow-amber-500/20 mb-4">
                    Bayar Sekarang
                </button>

                <a href="{{ route('academy.batch', $batch->uuid) }}"
                    class="block text-gray-500 hover:text-gray-300 text-sm transition-colors">
                    Batal
                </a>
            </div>
        </div>
    </div>

    @if(config('services.midtrans.is_production'))
        <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
    @else
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
    @endif

    <script>
        document.getElementById('pay-button').onclick = function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
                    window.location.href = '{{ route('academy.order.finish') }}?order_id=' + result.order_id;
                },
                onPending: function (result) {
                    window.location.href = '{{ route('academy.order.finish') }}?order_id=' + result.order_id;
                },
                onError: function (result) {
                    alert('Pembayaran gagal. Silakan coba lagi.');
                },
                onClose: function () {
                    // user closed popup
                }
            });
        };
    </script>
</x-layouts.base>
