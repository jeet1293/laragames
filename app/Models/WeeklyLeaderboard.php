<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeeklyLeaderboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'point',
        'weeknumber',
        'year'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
