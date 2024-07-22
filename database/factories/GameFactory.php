<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'win_point' => fake()->numberBetween(1, 100),
        ];
    }

    public function withExistingUser()
    {
        return $this->afterCreating(function (Game $game) {
            $user = User::inRandomOrder()->first();
            $game->users()->attach($user);
        });
    }
}
