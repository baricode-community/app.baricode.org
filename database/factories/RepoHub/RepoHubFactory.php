<?php

namespace Database\Factories\RepoHub;

use App\Models\RepoHub\RepoHub;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<RepoHub>
 */
class RepoHubFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->words(3, true);

        return [
            'title' => ucwords($title),
            'slug' => Str::slug($title).'-'.$this->faker->unique()->numberBetween(1, 9999),
            'description' => $this->faker->paragraph(3),
            'repo_url' => 'https://github.com/'.$this->faker->userName().'/'.$this->faker->slug(2),
            'demo_url' => $this->faker->boolean(60) ? $this->faker->url() : null,
            'why_recommended' => $this->faker->paragraph(2),
            'is_published' => $this->faker->boolean(80),
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => true,
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => false,
        ]);
    }
}
