<?php

namespace Database\Factories;

use App\Models\Meet;
use App\Models\User;
use App\Models\UserMeet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserMeet>
 */
class UserMeetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'meet_id' => Meet::factory(),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}
