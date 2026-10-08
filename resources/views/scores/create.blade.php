@extends('layouts.app')

@section('content')
<h1>Create Score</h1>
<form action="{{ route('scores.store') }}" method="POST" class="mt-4">
    @csrf
    <div class="mb-3">
        <label class="form-label">Game ID</label>
        <input type="number" name="game_id" class="form-control" value="{{ old('game_id') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Team ID</label>
        <input type="number" name="team_id" class="form-control" value="{{ old('team_id') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Points</label>
        <input type="number" name="points" class="form-control" value="{{ old('points') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Quarter</label>
        <input type="number" name="quarter" class="form-control" value="{{ old('quarter') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Score Type</label>
        <input type="text" name="score_type" class="form-control" value="{{ old('score_type') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Score Time</label>
        <input type="time" name="score_time" class="form-control" value="{{ old('score_time') }}">
    </div>
    <button type="submit" class="btn btn-success">Create</button>
    <a href="{{ route('scores.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection