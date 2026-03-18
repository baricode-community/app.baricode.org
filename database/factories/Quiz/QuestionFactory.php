<?php

namespace Database\Factories\Quiz;

use App\Models\Quiz\Question;
use App\Models\Quiz\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Question>
 */
class QuestionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'quiz_id' => Quiz::factory(),
            'question_text' => $this->faker->sentence(8).'?',
            'order' => $this->faker->numberBetween(1, 20),
        ];
    }
}
