<?php

namespace Database\Factories;

use App\Models\DailyCommitTracker;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<DailyCommitTracker>
 */
class DailyCommitTrackerFactory extends Factory
{
    protected $model = DailyCommitTracker::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::random(5),
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(3),
            'message' => $this->faker->paragraph(),
            'impression' => $this->faker->paragraph(),
            'success_level' => $this->faker->numberBetween(1, 10),
            'tracked_date' => $this->faker->dateTimeThisMonth(),
        ];
    }
}
