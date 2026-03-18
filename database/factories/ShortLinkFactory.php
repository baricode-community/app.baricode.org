<?php

namespace Database\Factories;

use App\Models\ShortLink;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<ShortLink>
 */
class ShortLinkFactory extends Factory
{
    protected $model = ShortLink::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(3, false);

        return [
            'title' => $title,
            'description' => $this->faker->optional()->paragraph(),
            'real_url' => $this->faker->url(),
            'slug' => Str::slug($title).'-'.$this->faker->unique()->randomNumber(4),
            'expired_at' => $this->faker->optional(0.3)->dateTimeBetween('+1 day', '+1 year'),
            'is_active' => $this->faker->boolean(80),
            'click_count' => $this->faker->numberBetween(0, 500),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
            'expired_at' => null,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    public function expired(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
            'expired_at' => now()->subDay(),
        ]);
    }
}
