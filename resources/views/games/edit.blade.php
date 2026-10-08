@extends('layouts.app')

@section('content')
<h1>Edit Game</h1>
<form action="{{ route('games.update', $game) }}" method="POST" class="mt-4">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Team ID</label>
        <input type="number" name="team_id" class="form-control" value="{{ old('team_id', $game->team_id) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Date</label>
        <input type="date" name="game_date" class="form-control" value="{{ old('game_date', $game->game_date) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Time</label>
        <input type="time" name="time" class="form-control" value="{{ old('time', $game->time) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Venue</label>
        <input type="text" name="venue" class="form-control" value="{{ old('venue', $game->venue) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="game_status" class="form-select">
            <option value="Scheduled" {{ old('game_status', $game->game_status) == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
            <option value="Ongoing" {{ old('game_status', $game->game_status) == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
            <option value="Completed" {{ old('game_status', $game->game_status) == 'Completed' ? 'selected' : '' }}>Completed</option>
            <option value="Cancelled" {{ old('game_status', $game->game_status) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('games.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection