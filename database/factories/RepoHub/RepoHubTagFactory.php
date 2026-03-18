<?php

namespace Database\Factories\RepoHub;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RepoHub\RepoHubTag>
 */
class RepoHubTagFactory extends Factory
{
    public function definition(): array
    {
        $tags = ['Laravel', 'Vue', 'React', 'Go', 'Python', 'JavaScript', 'TypeScript', 'Rust', 'Docker', 'DevOps', 'CLI', 'API', 'Machine Learning', 'Open Source', 'PHP', 'Node.js', 'Flutter', 'Dart'];
        $name = $this->faker->unique()->randomElement($tags);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
