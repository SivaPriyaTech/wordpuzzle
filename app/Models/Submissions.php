<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Submissions extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'word',
        'points',
        'used_letters',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
