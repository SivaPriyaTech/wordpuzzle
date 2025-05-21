<?php

namespace App\Models;
use App\Models\Games;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table = 'students';
    protected $fillable = ['name', 'email'];

    public function games()
    {
        return $this->hasMany(Games::class);
    }
}
