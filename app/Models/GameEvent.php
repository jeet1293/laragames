<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'name',
        'point',
        'start_date',
        'end_date'  
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
