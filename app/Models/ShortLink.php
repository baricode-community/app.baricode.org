<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'real_url',
        'slug',
        'expired_at',
        'is_active',
        'click_count',
    ];

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'real_url' => 'string',
        'slug' => 'string',
        'expired_at' => 'datetime',
        'is_active' => 'boolean',
        'click_count' => 'integer',
    ];

    public function isExpired(): bool
    {
        return $this->expired_at !== null && $this->expired_at->isPast();
    }

    public function isAccessible(): bool
    {
        return $this->is_active && ! $this->isExpired();
    }

    public function incrementClicks(): void
    {
        $this->increment('click_count');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expired_at')
                    ->orWhere('expired_at', '>', now());
            });
    }
}
