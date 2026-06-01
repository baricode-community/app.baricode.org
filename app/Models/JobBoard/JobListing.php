<?php

namespace App\Models\JobBoard;

use App\Enums\JobBoard\JobListingStatus;
use App\Enums\JobBoard\JobType;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'company_name',
        'company_logo',
        'description',
        'requirements',
        'location',
        'is_remote',
        'job_type',
        'tech_stack',
        'salary_min',
        'salary_max',
        'salary_currency',
        'apply_url',
        'apply_email',
        'status',
        'rejection_note',
        'expires_at',
        'views_count',
    ];

    protected $casts = [
        'is_remote' => 'boolean',
        'job_type' => JobType::class,
        'tech_stack' => 'array',
        'salary_min' => 'integer',
        'salary_max' => 'integer',
        'status' => JobListingStatus::class,
        'expires_at' => 'datetime',
        'views_count' => 'integer',
    ];

    public static function generateSlug(): string
    {
        do {
            $slug = Str::lower(Str::random(5));
        } while (self::where('slug', $slug)->exists());

        return $slug;
    }

    public function poster(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', JobListingStatus::Approved);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->approved()->where(function ($q) {
            $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
        });
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', JobListingStatus::Pending);
    }

    public function isPending(): bool
    {
        return $this->status === JobListingStatus::Pending;
    }

    public function isApproved(): bool
    {
        return $this->status === JobListingStatus::Approved;
    }

    public function isRejected(): bool
    {
        return $this->status === JobListingStatus::Rejected;
    }

    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at->isPast();
    }

    public function approve(): void
    {
        $this->update([
            'status' => JobListingStatus::Approved,
            'rejection_note' => null,
        ]);
    }

    public function reject(string $note): void
    {
        $this->update([
            'status' => JobListingStatus::Rejected,
            'rejection_note' => $note,
        ]);
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function hasSalary(): bool
    {
        return $this->salary_min !== null || $this->salary_max !== null;
    }

    public function formattedSalary(): string
    {
        if (! $this->hasSalary()) {
            return 'Negosiasi';
        }

        $currency = $this->salary_currency;
        $format = fn ($n) => number_format($n, 0, ',', '.');

        if ($this->salary_min && $this->salary_max) {
            return "{$currency} {$format($this->salary_min)} – {$format($this->salary_max)}";
        }

        if ($this->salary_min) {
            return "{$currency} {$format($this->salary_min)}+";
        }

        return "s/d {$currency} {$format($this->salary_max)}";
    }
}
