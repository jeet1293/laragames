<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'param',
        'value'
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
