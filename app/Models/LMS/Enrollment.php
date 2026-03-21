<?php

namespace App\Models\LMS;

use App\Enums\LMS\EnrollmentStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'rejection_reason',
        'approved_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => EnrollmentStatus::class,
            'approved_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function lessonProgress(): HasMany
    {
        return $this->hasMany(LessonProgress::class);
    }

    public function categoryProgress(): HasMany
    {
        return $this->hasMany(CategoryProgress::class);
    }

    public function isActive(): bool
    {
        return $this->status === EnrollmentStatus::Active;
    }

    public function isCompleted(): bool
    {
        return $this->status === EnrollmentStatus::Completed;
    }

    /**
     * Check if all categories are approved and mark the enrollment as completed.
     */
    public function checkAndMarkCompleted(): void
    {
        $totalCategories = $this->course->categories()
            ->where('is_published', true)
            ->count();

        if ($totalCategories === 0) {
            return;
        }

        $approvedCategories = $this->categoryProgress()
            ->where('status', \App\Enums\LMS\CategoryProgressStatus::Approved->value)
            ->count();

        if ($approvedCategories >= $totalCategories) {
            $this->update([
                'status' => EnrollmentStatus::Completed,
                'completed_at' => now(),
            ]);
        }
    }
}
