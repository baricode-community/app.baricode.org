<?php

namespace Database\Factories;

use App\Models\Meet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Meet>
 */
class MeetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraph(),
            'scheduled_at' => $this->faker->dateTimeBetween('now', '+1 month'),
            'status' => $this->faker->randomElement(['scheduled', 'in_progress', 'completed', 'cancelled']),
        ];
    }
}
