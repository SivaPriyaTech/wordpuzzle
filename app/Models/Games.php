<?php

namespace App\Models;

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
        return $this->hasMany(Submission::class);
    }
}
