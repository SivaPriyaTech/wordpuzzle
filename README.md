Laravel - Backend services

This Laravel application is to build a back-end service that processes student submissions for
word puzzles, grades them and presents a high-score leaderboard.

Basically, it is a  word puzzle game where students are given a randomly generated string of letters and must form valid English words. Each valid word scores points based on its length. Users cannot reuse letters across multiple words, and a leaderboard maintains the top 10 highest-scoring unique submissions.

Features:

1. Puzzle string generation with at least one valid word
2. Validates English words via dictionaryapi.dev
3. Prevents reuse of letters once consumed by a word
4. Calculates score based on word length
5. Maintains a top 10 leaderboard with unique high-scoring words

Why this Approach?

Separation of Concerns: Business logic like puzzle generation is placed in a reusable trait (PuzzleTrait), keeping controllers clean.

API Integration: Validates user-submitted words against a real English dictionary API to ensure reliability.

Session-based Game Flow: Tracks each user's puzzle session, submissions, and remaining letters using Laravel's session and Eloquent features.


Setup Instructions

1. Clone the repository
    Repo - https://github.com/SivaPriyaTech/wordpuzzle
    cd wordpuzzle

2. Install Dependencies
    composer install

3. Configure the Environment
    Copy .env.example to .env and update your DB settings
    Generate API key - php artisan key:generate

4. Run migrations
    php artisan migrate

5. Serve the application 
    php artisan serve

Open http://localhost:8000 in your browser.

Testing the game:

1. Register as a new user
2. A random puzzle string is generated
3. Enter possible valid English words in the form
4. The backend will validate, score, and update the leaderboard