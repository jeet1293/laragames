<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DailyLeaderboard>
 */
class DailyLeaderboardFactory extends Factory
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
            'date' => fake()->dateTimeBetween('-5 days', '+1 day'),
        ];
    }
}
