<?php

namespace Database\Factories\LMS;

use App\Models\LMS\CourseCategory;
use App\Models\LMS\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => CourseCategory::factory(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'content' => $this->faker->paragraphs(3, true),
            'video_url' => $this->faker->optional(0.5)->url(),
            'order' => $this->faker->numberBetween(0, 20),
            'duration' => $this->faker->numberBetween(5, 120),
            'is_published' => $this->faker->boolean(85),
        ];
    }
}
