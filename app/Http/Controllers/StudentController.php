<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Games;

class StudentController extends Controller
{
    //

    public function register(Request $request){
        $validated = $request -> validate([
            'name' => 'required|string ',
            'email' => 'required|email|unique:students,email'
        ]);

        $student = Student::create($validated);

        $puzzleString = $this->generatePuzzleString();

        $game = Games::create([
            'student_id' => $student->id,
            'puzzle_string' => $puzzleString,
            'remaining_letters' => $puzzleString,
            'score' => 0,
            'is_finished' => false,
        ]);

        // Store in session
        session([
            'student_id' => $student->id,
            'student_name' => $student->name,
            'game_id' => $game->id,
            'puzzle_string' => $puzzleString
        ]);
        return redirect()->route('index');
    }

    private function generatePuzzleString()
    {
        $letters = 'abcdefghijklmnopqrstuvwxyz';
        $length = 14;
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $letters[rand(0, 25)];
        }

        return $string;
    }
}
