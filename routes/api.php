<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\LeaderboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);


    // Leaderboards
    Route::prefix('leaderboard')->group(function(){
        Route::get('/daily', [LeaderboardController::class, 'daily']);
        Route::post('/daily', [LeaderboardController::class, 'updateDaily']);
        Route::get('/weekly', [LeaderboardController::class, 'weekly']);
    });
});