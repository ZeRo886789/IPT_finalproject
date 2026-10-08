@extends('layouts.app')

@section('content')
<h1>Games</h1>
<a href="{{ route('games.create') }}" class="btn btn-primary mb-3">Add New Game</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Time</th>
            <th>Venue</th>
            <th>Status</th>
            <th>Team</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($games as $game)
        <tr>
            <td>{{ $game->game_id }}</td>
            <td>{{ $game->game_date }}</td>
            <td>{{ $game->time }}</td>
            <td>{{ $game->venue }}</td>
            <td>{{ $game->game_status }}</td>
            <td>{{ $game->team->team_name ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('games.edit', $game) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('games.destroy', $game) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this game?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection