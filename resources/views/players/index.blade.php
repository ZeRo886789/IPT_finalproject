@extends('layouts.app')

@section('content')
<h1>Players</h1>
<a href="{{ route('players.create') }}" class="btn btn-primary mb-3">Add New Player</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Jersey</th>
            <th>Position</th>
            <th>Age</th>
            <th>Team</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($players as $player)
        <tr>
            <td>{{ $player->player_id }}</td>
            <td>{{ $player->name }}</td>
            <td>{{ $player->jersey_no }}</td>
            <td>{{ $player->position }}</td>
            <td>{{ $player->age }}</td>
            <td>{{ $player->team->team_name ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('players.edit', $player) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('players.destroy', $player) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this player?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection