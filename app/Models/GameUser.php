<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameUser extends Model
{
    use HasFactory;

    protected $table = 'game_user';

    protected $fillable = [
        'game_id',
        'user_id'
    ];
}
