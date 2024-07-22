<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\GameEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GameEvent>
 */
class GameEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $endDate = (clone $startDate)->modify('+'.rand(1, 10).' days');

        return [
            'game_id' => Game::factory()->create(),
            'name' => fake()->word(),
            'point' => fake()->numberBetween(1, 1000),
            'start_date' => $startDate,
            'end_date' => $endDate
        ];
    }

    public function withExistingGame()
    {
        return $this->state(function (array $attributes) {
            return [
                'game_id' => Game::inRandomOrder()->first(),
            ];
        });
    }
}
