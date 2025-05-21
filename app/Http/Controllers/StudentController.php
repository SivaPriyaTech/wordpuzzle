<?php

namespace App\Http\Controllers;
use App\Traits\PuzzleTraits;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Games;

class StudentController extends Controller
{
    use PuzzleTraits;
    public function register(Request $request){
        $validated = $request -> validate([
            'name' => 'required|string ',
            'email' => 'required|email'
        ]);

        $student = Student::firstOrCreate(
            ['email' => $validated['email']],
            ['name' => $validated['name']]
        );

        $puzzleString = $this->generatePuzzleString();

        $game = Games::create([
            'student_id' => $student->id,
            'puzzle_string' => $puzzleString,
            'remaining_letters' => $puzzleString,
            'score' => 0,
            'is_finished' => false,
        ]);

        session([
            'student_id' => $student->id,
            'student_name' => $student->name,
            'game_id' => $game->id,
            'puzzle_string' => $puzzleString
        ]);
        return redirect()->route('index');
    }

 

    public function logout(Request $request)
    {
        session()->flush(); 
        return redirect('/')->with('message', 'You have been logged out.');
    }
}
