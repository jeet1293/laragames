<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\DailyLeaderboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class LeaderboardController extends Controller
{
    public function daily(Request $request)
    {
        $date = now()->toDateString();

        $topUsersCacheKey = "daily_leaderboard_top_10_{$date}";
        $currentUserCacheKey = "daily_leaderboard_user_rank_{$date}_" . Auth::id();

        $top10Users = Cache::remember($topUsersCacheKey, 60, function () use ($date) {
            return DailyLeaderboard::query()
                ->with('user')
                ->where('date', $date)
                ->orderBy('point', 'desc')
                ->take(10)
                ->get();
        });

        $currentUserRank = Cache::remember($currentUserCacheKey, 60, function () use ($date) {
            $currentUserLeaderboard = DailyLeaderboard::query()
                ->where('user_id', Auth::id())
                ->where('date', $date)
                ->first();

            if ($currentUserLeaderboard) {
                return DailyLeaderboard::query()
                    ->where('date', $date)
                    ->where('point', '>', $currentUserLeaderboard->points)
                    ->count() + 1;
            }

            return null;
        });

        $response = [
            'success' => true,
            'message' => 'Daily leaderboard data',
            'data' => [
                'top10' => $top10Users,
                'currentUserRank' => $currentUserRank
            ]
        ];

        return response()->json($response, 200);
    }

    public function updateDaily(Request $request)
    {
        $date = now()->toDateString();

        $validator = Validator::make($request->all(),[
            'point' => 'required|numeric'
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => 'Validation Error',
                'data' => [$validator->errors()]
            ];
      
            return response()->json($response, 401);
        }

        $newPoint = $validator->validated()['point'];


        DailyLeaderboard::updateOrCreate([
            'user_id' => Auth::id(),
            'date' => $date
        ], ['point' => $newPoint]);

        $currentUserCacheKey = "daily_leaderboard_user_rank_{$date}_" . Auth::id();

        Cache::forget($currentUserCacheKey);

        $currentUserRank = Cache::remember($currentUserCacheKey, 60, function () use ($date, $newPoint) {
            return DailyLeaderboard::query()
                ->where('date', $date)
                ->where('point', '>', $newPoint)
                ->count() + 1;
        });

        $response = [
            'success' => true,
            'message' => 'Updated user leaderboard data',
            'data' => [
                'currentUserRank' => $currentUserRank
            ]
        ];

        return response()->json($response, 200);

    }

    public function Weekly(Request $request)
    {
        $response = [
            'success' => true,
            'message' => 'TODO',
            'data' => []
        ];

        return response()->json($response, 200);
    }
}
