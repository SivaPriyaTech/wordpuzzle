<?php
namespace App\Traits;

trait PuzzleTraits
{
    public function generatePuzzleString()
    {

        $wordList = ['apple', 'train', 'house', 'light', 'world', 'music', 'dream', 'stone'];

        $word = $wordList[array_rand($wordList)];
        $wordLength = strlen($word);
        $totalLength = 14;

        $remainingLength = $totalLength - $wordLength;

        $letters = 'abcdefghijklmnopqrstuvwxyz';
        $filler = '';
        for ($i = 0; $i < $remainingLength; $i++) {
            $filler .= $letters[rand(0, 25)];
        }

        $combined = str_shuffle($word . $filler);

        return $combined;
    }

    public  function calculateGrade($score) {
        if ($score >= 20) return 'A';
        if ($score >= 15) return 'B';
        if ($score >= 10) return 'C';
        if ($score >= 5) return 'D';
        return 'F';
    }
}