<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'win_point'
    ];

    public function events(): HasMany
    {
        return $this->hasMany(GameEvent::class);
    }

    public function settings(): HasMany
    {
        return $this->hasMany(GameSetting::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'game_user')->withTimestamps();
    }
}
