<?php

namespace App\Models\Onboarding;

use App\Models\User;
use Database\Factories\Onboarding\OnboardingTaskCompletionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OnboardingTaskCompletion extends Model
{
    /** @use HasFactory<OnboardingTaskCompletionFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'onboarding_task_id',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(OnboardingTask::class, 'onboarding_task_id');
    }
}
