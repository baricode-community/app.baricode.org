<?php

namespace App\Models\Academy;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class AcademyBatch extends Model
{
    protected $fillable = [
        'uuid',
        'academy_program_id',
        'name',
        'price',
        'quota',
        'registration_open_at',
        'registration_close_at',
        'start_at',
        'end_at',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'price' => 'integer',
            'quota' => 'integer',
            'registration_open_at' => 'datetime',
            'registration_close_at' => 'datetime',
            'start_at' => 'datetime',
            'end_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(AcademyProgram::class, 'academy_program_id');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(AcademySession::class)->orderBy('sort_order');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(AcademyEnrollment::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function isRegistrationOpen(): bool
    {
        $now = now();

        if (! $this->is_active) {
            return false;
        }

        if ($this->registration_open_at && $now->lt($this->registration_open_at)) {
            return false;
        }

        if ($this->registration_close_at && $now->gt($this->registration_close_at)) {
            return false;
        }

        return $this->enrollments()->count() < $this->quota;
    }

    public function enrolledCount(): int
    {
        return $this->enrollments()->count();
    }

    public function formattedPrice(): string
    {
        return 'Rp '.number_format($this->price, 0, ',', '.');
    }
}
