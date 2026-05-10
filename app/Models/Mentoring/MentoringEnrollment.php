<?php

namespace App\Models\Mentoring;

use App\Enums\Mentoring\MentoringEnrollmentStatus;
use App\Models\User;
use Database\Factories\Mentoring\MentoringEnrollmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class MentoringEnrollment extends Model
{
    use HasFactory;

    protected static function newFactory(): MentoringEnrollmentFactory
    {
        return MentoringEnrollmentFactory::new();
    }

    protected $fillable = [
        'uuid',
        'mentoring_program_id',
        'user_id',
        'status',
        'goal_notes',
        'rejection_reason',
        'started_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => MentoringEnrollmentStatus::class,
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
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
        return $this->belongsTo(MentoringProgram::class, 'mentoring_program_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(MentoringSession::class)->orderBy('session_date');
    }

    public function isActive(): bool
    {
        return $this->status === MentoringEnrollmentStatus::Active;
    }

    public function isPending(): bool
    {
        return $this->status === MentoringEnrollmentStatus::Pending;
    }
}
