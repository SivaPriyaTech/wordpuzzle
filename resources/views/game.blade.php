@if (session()->has('student_name'))
    <div class="alert alert-success">
        Welcome, {{ session('student_name') }}! Let's play.
    </div>
@endif

<div class="alert alert-info mt-3">
  <h5 class="text-primary">📘 How to Play</h5>
  <ul class="mb-0">
    <li>A random word will be generated.</li>
    <li>Your task is to rearrange the letters to form valid English words.</li>
    <li>You can submit multiple words separated by commas or spaces.</li>
    <li>Each valid word earns points based on its length and uniqueness.</li>
    <li>Try to score higher than others and climb the leaderboard!</li>
  </ul>
</div>

@if (session()->has('puzzle_string'))
      <div class="alert alert-dark" id="puzzleStringDisplay">
        <strong>Puzzle String:</strong> <span id="puzzleStringText">{{ session('puzzle_string') }}</span>
    </div>
@endif

<form method="POST" action="{{ route('submit.words') }}" id="wordsForm">
    @csrf
    <div class="form-group">
        <label for="words">Enter your words (separated by comma or space):</label>
        <input type="text" name="words" id="words" class="form-control" required>
    </div>
    <div id="error-message" style="color: red; margin-top: 0.5rem;"></div>
    <button type="submit" class="btn btn-primary mt-2">Submit Words</button>
</form>

<script>
    const originalPuzzle = @json(session('puzzle_string', '')).toLowerCase();
    const puzzleDisplay = document.getElementById('puzzleStringDisplay');
    const wordsInput = document.getElementById('words');
    const errorMessageDiv = document.getElementById('error-message');
    const form = document.getElementById('wordsForm');

    function updatePuzzleStringDisplay() {
        const inputText = wordsInput.value.toLowerCase();
        const inputLetters = inputText.replace(/[\s,]+/g, '').split('');

        let puzzleLetterCount = {};
        for (const letter of originalPuzzle) {
            puzzleLetterCount[letter] = (puzzleLetterCount[letter] || 0) + 1;
        }

        let inputLetterCount = {};
        for (const letter of inputLetters) {
            inputLetterCount[letter] = (inputLetterCount[letter] || 0) + 1;
        }

        let invalidLetters = [];
        for (const letter in inputLetterCount) {
            if (!puzzleLetterCount[letter] || inputLetterCount[letter] > puzzleLetterCount[letter]) {
                invalidLetters.push(letter);
            }
        }

        if (invalidLetters.length > 0) {
            errorMessageDiv.textContent = `Please enter valid letters only. Invalid letter(s): ${invalidLetters.join(', ')}`;
        } else {
            errorMessageDiv.textContent = '';
        }

        let remainingLetters = '';
        for (const letter in puzzleLetterCount) {
            const countInPuzzle = puzzleLetterCount[letter];
            const countUsed = inputLetterCount[letter] || 0;
            const remainingCount = countInPuzzle - countUsed;
            if (remainingCount > 0) {
                remainingLetters += letter.repeat(remainingCount);
            }
        }

        puzzleDisplay.textContent = remainingLetters;

        // Return whether input is valid or not for form submit handler
        return invalidLetters.length === 0;
    }

    wordsInput.addEventListener('input', updatePuzzleStringDisplay);

    form.addEventListener('submit', function(e) {
        if (!updatePuzzleStringDisplay()) {
            e.preventDefault(); // Stop form submit
            alert('Please fix errors before submitting.');
        }
    });

    updatePuzzleStringDisplay();
</script>