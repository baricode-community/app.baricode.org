<?php

namespace Database\Factories;

use App\Models\CheatSheetCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CheatSheetCategory>
 */
class CheatSheetCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => $this->faker->unique()->randomElement([
                'Git', 'Linux / Terminal', 'SQL / Database', 'Docker',
                'JavaScript', 'Python', 'PHP / Laravel', 'HTML / CSS',
                'REST API', 'Regex', 'Vim / Editor', 'General',
            ]),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}
