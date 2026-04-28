<?php

namespace App\Models\LMS;

use App\Enums\LMS\CategoryProgressStatus;
use App\Enums\Quiz\QuizAttemptStatus;
use App\Models\Quiz\QuizAttempt;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryProgress extends Model
{
    protected $table = 'category_progress';

    protected $fillable = [
        'enrollment_id',
        'category_id',
        'status',
        'admin_note',
        'approved_by',
        'submitted_at',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => CategoryProgressStatus::class,
            'submitted_at' => 'datetime',
            'approved_at' => 'datetime',
        ];
    }

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function isLocked(): bool
    {
        return in_array($this->status, [
            CategoryProgressStatus::Submitted,
            CategoryProgressStatus::Approved,
        ]);
    }

    public function hasPassedRequiredQuiz(): bool
    {
        $category = $this->category;

        if (! $category->requiresQuiz()) {
            return true;
        }

        $userId = $this->enrollment->user_id;

        return QuizAttempt::where('user_id', $userId)
            ->where('quiz_id', $category->quiz_id)
            ->where('status', QuizAttemptStatus::Passed->value)
            ->when($category->passing_score, function ($query) use ($category) {
                $query->where('score', '>=', $category->passing_score);
            })
            ->exists();
    }
}
