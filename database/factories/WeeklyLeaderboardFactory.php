<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WeeklyLeaderboard>
 */
class WeeklyLeaderboardFactory extends Factory
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
            'weeknumber' => fake()->numberBetween(1, 52),
            'year' => fake()->unique()->dateTimeBetween('-4 years', 'now')->format('Y'),
        ];
    }
}
