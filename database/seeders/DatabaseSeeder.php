<?php

namespace Database\Seeders;

use App\Models\DailyLeaderboard;
use App\Models\Game;
use App\Models\GameEvent;
use App\Models\GameSetting;
use App\Models\User;
use App\Models\UserPoint;
use App\Models\WeeklyLeaderboard;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Game::factory()->count(100)->create();

        User::factory()
            ->count(100000)
            ->withExistingGame()
            ->create();

        Game::factory()
            ->count(10)
            ->withExistingUser()
            ->create();

        GameEvent::factory()
            ->count(10)
            ->withExistingGame()
            ->create();

        GameSetting::factory()
            ->count(10)
            ->withExistingGame()
            ->create();

        Game::factory()
            ->count(10)
            ->withExistingUser()
            ->create();

        DailyLeaderboard::factory()
            ->count(50)
            ->create();

        WeeklyLeaderboard::factory()
            ->count(50)
            ->create();

        UserPoint::factory()
            ->count(200)
            ->create();
            
    }
}
