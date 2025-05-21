<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use App\Traits\PuzzleTraits;
use Illuminate\Http\Request;
use App\Models\Games;
use App\Models\Submissions;

class GameController extends Controller
{
   use PuzzleTraits;
   public function submit(Request $request)
    {
        $wordsInput = $request->input('words');
        $submittedWords = preg_split('/[\s,]+/', strtolower($wordsInput));
        $gameId = session('game_id');
        $originalPuzzle = session('puzzle_string');

        $client = new Client();
        $totalPoints = 0;
        $usedLetters = '';

        $validWords = [];

        foreach ($submittedWords as $word) {
            if (empty($word)) continue;

            try {
                $response = $client->get("https://api.dictionaryapi.dev/api/v2/entries/en/{$word}");

                if ($response->getStatusCode() === 200) {
                    $points = strlen($word);
                    $totalPoints += $points;
                    $usedLetters .= $word;

                    Submissions::create([
                        'game_id' => $gameId,
                        'word' => $word,
                        'points' => $points,
                        'used_letters' => $word,
                    ]);

                    $validWords[] = $word;
                }
            } catch (\Exception $e) {
                continue;
            }
        }

        $game = Games::find($gameId);
        if ($game) {
            $remaining = str_split($game->remaining_letters);
            foreach (str_split($usedLetters) as $char) {
                $key = array_search($char, $remaining);
                if ($key !== false) {
                    unset($remaining[$key]);
                }
            }

            $game->score += $totalPoints;
            $game->remaining_letters = implode('', $remaining);
            $game->grade = $this->calculateGrade($game->score);
            $game->save();
        }

        $puzzleString = $this->generatePuzzleString();

        $game = Games::create([
            'student_id' =>  session('student_id'),
            'puzzle_string' => $puzzleString,
            'remaining_letters' => $puzzleString,
            'score' => 0,
            'is_finished' => false,
        ]);

        session([
            'game_id' => $game->id,
            'puzzle_string' => $puzzleString
        ]);

        return redirect()->back()->with('message', 'Words submitted: ' . implode(', ', $validWords) . 'Total points:' .$totalPoints, );
    }

    public function index()
    {
        $top = Submissions::select('word', 'points')
        ->orderByDesc('points')
        ->get()
        ->unique('word')
        ->take(10);

        return view('index', compact('top'));
    }



}
