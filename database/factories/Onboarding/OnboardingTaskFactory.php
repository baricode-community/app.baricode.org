<?php

namespace Database\Factories\Onboarding;

use App\Models\Onboarding\OnboardingTask;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<OnboardingTask>
 */
class OnboardingTaskFactory extends Factory
{
    protected $model = OnboardingTask::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(4);

        return [
            'title'       => $title,
            'slug'        => Str::slug($title),
            'description' => $this->faker->sentence(),
            'content'     => "## {$title}\n\n" . $this->faker->paragraphs(2, true),
            'icon'        => $this->faker->randomElement(['🚀', '📚', '🔥', '💻', '👤']),
            'order'       => $this->faker->numberBetween(1, 10),
            'is_active'   => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(['is_active' => false]);
    }
}
