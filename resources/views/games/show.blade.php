@extends('layouts.app')

@section('content')
<h1>Game Details</h1>

<table class="table table-bordered w-50">
    <tr>
        <th>ID</th><td>{{ $game->game_id }}</td>
    </tr>
    <tr>
        <th>Team</th><td>{{ $game->team->team_name ?? 'N/A' }}</td>
    </tr>
    <tr>
        <th>Game Date</th><td>{{ $game->game_date }}</td>
    </tr>
    <tr>
        <th>Venue</th><td>{{ $game->venue }}</td>
    </tr>
    <tr>
        <th>Time</th><td>{{ $game->time }}</td>
    </tr>
    <tr>
        <th>Status</th><td>{{ $game->game_status }}</td>
    </tr>
</table>

<a href="{{ route('games.edit', $game) }}" class="btn btn-warning">Edit</a>
<form action="{{ route('games.destroy', $game) }}" method="POST" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this game?')">Delete</button>
</form>
@endsection
