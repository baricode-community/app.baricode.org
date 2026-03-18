<?php

namespace Database\Factories\LMS;

use App\Models\LMS\Course;
use App\Models\LMS\CourseCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<CourseCategory>
 */
class CourseCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(3);

        return [
            'course_id' => Course::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph(),
            'order' => $this->faker->numberBetween(0, 10),
            'is_published' => $this->faker->boolean(80),
        ];
    }
}
