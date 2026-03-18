<?php

namespace Database\Factories\Quiz;

use App\Models\Quiz\Option;
use App\Models\Quiz\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Option>
 */
class OptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'question_id' => Question::factory(),
            'option_text' => $this->faker->sentence(5),
            'score' => $this->faker->numberBetween(0, 20),
            'is_correct' => false,
        ];
    }

    public function correct(): static
    {
        return $this->state(['is_correct' => true]);
    }
}
