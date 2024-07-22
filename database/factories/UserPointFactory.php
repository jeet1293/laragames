<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserPoint>
 */
class UserPointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(),
            'point' => fake()->numberBetween(1, 1000),
            'type' => fake()->randomElement(['play', 'win', 'daily_login', 'weekly_login', 'event', 'level'])
        ];
    }
}
