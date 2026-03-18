<?php

namespace Database\Factories;

use App\Models\Timeline;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Timeline>
 */
class TimelineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['pending', 'ongoing', 'completed', 'cancelled'];
        $startDate = $this->faker->dateTimeBetween('-3 months', 'now');

        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement($statuses),
            'start_date' => $startDate,
            'end_date' => $this->faker->dateTimeBetween($startDate, '+3 months'),
            'progress' => $this->faker->numberBetween(0, 100),
            'notes' => $this->faker->optional()->paragraph(),
        ];
    }
}
