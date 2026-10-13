@extends('layouts.app')

@section('content')
<h1>Player Details</h1>

<table class="table table-bordered w-50">
    <tr>
        <th>ID</th><td>{{ $player->player_id }}</td>
    </tr>
    <tr>
        <th>Team</th><td>{{ $player->team->team_name ?? 'N/A' }}</td>
    </tr>
    <tr>
        <th>Name</th><td>{{ $player->name }}</td>
    </tr>
    <tr>
        <th>Jersey No</th><td>{{ $player->jersey_no }}</td>
    </tr>
    <tr>
        <th>Position</th><td>{{ $player->position }}</td>
    </tr>
    <tr>
        <th>Age</th><td>{{ $player->age }}</td>
    </tr>
</table>

<a href="{{ route('players.edit', $player) }}" class="btn btn-warning">Edit</a>
<form action="{{ route('players.destroy', $player) }}" method="POST" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this player?')">Delete</button>
</form>
@endsection
