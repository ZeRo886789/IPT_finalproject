@extends('layouts.app')

@section('content')
<h1>Score Details</h1>

<table class="table table-bordered w-50">
    <tr>
        <th>ID</th><td>{{ $score->score_id }}</td>
    </tr>
    <tr>
        <th>Game</th><td>{{ $score->game->venue ?? 'N/A' }}</td>
    </tr>
    <tr>
        <th>Team</th><td>{{ $score->team->team_name ?? 'N/A' }}</td>
    </tr>
    <tr>
        <th>Points</th><td>{{ $score->points }}</td>
    </tr>
    <tr>
        <th>Quarter</th><td>{{ $score->quarter }}</td>
    </tr>
    <tr>
        <th>Score Type</th><td>{{ $score->score_type }}</td>
    </tr>
    <tr>
        <th>Score Time</th><td>{{ $score->score_time }}</td>
    </tr>
</table>

<a href="{{ route('scores.edit', $score) }}" class="btn btn-warning">Edit</a>
<form action="{{ route('scores.destroy', $score) }}" method="POST" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this score?')">Delete</button>
</form>
@endsection
