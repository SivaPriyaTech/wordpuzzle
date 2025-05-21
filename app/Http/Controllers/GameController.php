<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Games;
use App\Models\Submissions;

class GameController extends Controller
{
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

                    // Save to submissions table
                    Submissions::create([
                        'game_id' => $gameId,
                        'word' => $word,
                        'points' => $points,
                        'used_letters' => $word,
                    ]);

                    $validWords[] = $word;
                }
            } catch (\Exception $e) {
                // Invalid word - skip
                continue;
            }
        }

        // Update game record
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

        return redirect()->back()->with('success', 'Words submitted: ' . implode(', ', $validWords));
    }

    function calculateGrade($score) {
        if ($score >= 20) return 'A';
        if ($score >= 15) return 'B';
        if ($score >= 10) return 'C';
        if ($score >= 5) return 'D';
        return 'F';
    }

    public function index()
    {
        $games = Games::with(['student', 'submissions'])
            ->orderByDesc('score')
            ->take(10)
            ->get();

        return view('index', compact('games'));
    }


}
