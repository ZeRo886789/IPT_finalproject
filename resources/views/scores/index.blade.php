@extends('layouts.app')

@section('content')
<h1>Scores</h1>
<a href="{{ route('scores.create') }}" class="btn btn-primary mb-3">Add New Score</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Game</th>
            <th>Team</th>
            <th>Points</th>
            <th>Quarter</th>
            <th>Type</th>
            <th>Time</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($scores as $score)
        <tr>
            <td>{{ $score->score_id }}</td>
            <td>{{ $score->game->game_id ?? 'N/A' }}</td>
            <td>{{ $score->team->team_name ?? 'N/A' }}</td>
            <td>{{ $score->points }}</td>
            <td>{{ $score->quarter }}</td>
            <td>{{ $score->score_type }}</td>
            <td>{{ $score->score_time }}</td>
            <td>
                <a href="{{ route('scores.edit', $score) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('scores.destroy', $score) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this score?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection