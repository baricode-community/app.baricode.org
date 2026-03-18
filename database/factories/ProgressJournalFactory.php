<?php

namespace Database\Factories;

use App\Models\ProgressJournal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProgressJournal>
 */
class ProgressJournalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'timeline_id' => $this->faker->randomDigitNotNull(),
            'description' => $this->faker->paragraph(),
            'progress_percentage' => $this->faker->numberBetween(0, 100),
        ];
    }
}
