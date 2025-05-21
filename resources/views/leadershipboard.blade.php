

<div class="text-center">
    <h2>🏆 Leaderboard</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Player</th>
                <th>Score</th>
                <th>Words Submitted</th>
            </tr>
        </thead>
        <tbody>
            @foreach($games as $index => $game)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $game->student->name }}</td>
                    <td>{{ $game->score }}</td>
                    <td>
                        {{ $game->submissions->pluck('word')->join(', ') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
