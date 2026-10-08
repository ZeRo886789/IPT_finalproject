@extends('layouts.app')

@section('content')
<h1>Edit Score</h1>
<form action="{{ route('scores.update', $score) }}" method="POST" class="mt-4">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Game ID</label>
        <input type="number" name="game_id" class="form-control" value="{{ old('game_id', $score->game_id) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Team ID</label>
        <input type="number" name="team_id" class="form-control" value="{{ old('team_id', $score->team_id) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Points</label>
        <input type="number" name="points" class="form-control" value="{{ old('points', $score->points) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Quarter</label>
        <input type="number" name="quarter" class="form-control" value="{{ old('quarter', $score->quarter) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Score Type</label>
        <input type="text" name="score_type" class="form-control" value="{{ old('score_type', $score->score_type) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Score Time</label>
        <input type="time" name="score_time" class="form-control" value="{{ old('score_time', $score->score_time) }}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('scores.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection