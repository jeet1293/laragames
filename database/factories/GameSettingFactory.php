<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\GameSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GameSetting>
 */
class GameSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'game_id' => Game::factory()->create(),
            'param' => fake()->word(),
            'value' => fake()->numberBetween(1, 1000)
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
