<?php

namespace App\Models\Certificate;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CertificateUser extends Pivot
{
    public $timestamps = true;

    protected $table = 'certificate_user';

    protected $fillable = [
        'certificate_id',
        'user_id',
        'issued_at',
        'notes',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
    ];

    public function certificate(): BelongsTo
    {
        return $this->belongsTo(Certificate::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
