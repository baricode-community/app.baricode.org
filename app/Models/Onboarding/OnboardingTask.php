<?php

namespace App\Models\Onboarding;

use App\Models\User;
use Database\Factories\Onboarding\OnboardingTaskFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OnboardingTask extends Model
{
    /** @use HasFactory<OnboardingTaskFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'icon',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order'     => 'integer',
    ];

    public function completions(): HasMany
    {
        return $this->hasMany(OnboardingTaskCompletion::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function isCompletedBy(User $user): bool
    {
        return $this->completions()
            ->where('user_id', $user->id)
            ->exists();
    }
}
