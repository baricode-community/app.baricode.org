<?php

namespace App\Models;

use App\Models\Academy\AcademyBatch;
use App\Models\Academy\AcademyEnrollment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'academy_batch_id',
        'amount',
        'status',
        'snap_token',
        'midtrans_transaction_id',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'paid_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(AcademyBatch::class, 'academy_batch_id');
    }

    public function enrollment(): HasOne
    {
        return $this->hasOne(AcademyEnrollment::class);
    }

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    public function midtransOrderId(): string
    {
        return 'ORDER-'.$this->uuid;
    }
}
