<?php

namespace Database\Factories\Onboarding;

use App\Models\Onboarding\OnboardingTask;
use App\Models\Onboarding\OnboardingTaskCompletion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OnboardingTaskCompletion>
 */
class OnboardingTaskCompletionFactory extends Factory
{
    protected $model = OnboardingTaskCompletion::class;

    public function definition(): array
    {
        return [
            'user_id'            => User::factory(),
            'onboarding_task_id' => OnboardingTask::factory(),
            'completed_at'       => now(),
        ];
    }
}
