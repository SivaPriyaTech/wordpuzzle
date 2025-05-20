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
    <div class="alert alert-dark">
        <strong>Puzzle String:</strong> {{ session('puzzle_string') }}
    </div>
@endif

<form method="POST" action="{{ route('submit.word') }}">
    @csrf
    <div class="form-group">
        <label for="words">Enter your words (separated by comma or space):</label>
        <input type="text" name="words" id="words" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Submit Words</button>
</form>


