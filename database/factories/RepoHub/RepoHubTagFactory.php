<?php

namespace Database\Factories\RepoHub;

use App\Models\RepoHub\RepoHubTag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<RepoHubTag>
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
