<?php

namespace App\Models;
use App\Models\Student;
use App\Models\Submissions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Games extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'puzzle_string',
        'remaining_letters',
        'score',
        'grade',
        'is_finished',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submissions::class, 'game_id');
    }
}
