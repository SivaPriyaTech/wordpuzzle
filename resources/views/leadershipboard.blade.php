

<div class="text-center">
    <h2>🏆 Leaderboard</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Word</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach($top as $index => $word)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $word->word}}</td>
                    <td>{{ $word->points }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
