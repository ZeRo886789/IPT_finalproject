@extends('layouts.app')

@section('content')
<h1>Coach Details</h1>

<table class="table table-bordered w-50">
    <tr>
        <th>ID</th><td>{{ $coach->coach_id }}</td>
    </tr>
    <tr>
        <th>Name</th><td>{{ $coach->coach_name }}</td>
    </tr>
    <tr>
        <th>Contact</th><td>{{ $coach->contact_no }}</td>
    </tr>
    <tr>
        <th>Experience</th><td>{{ $coach->experience_year }} years</td>
    </tr>
    <tr>
        <th>Specialization</th><td>{{ $coach->specialization }}</td>
    </tr>
</table>

<a href="{{ route('coaches.edit', $coach) }}" class="btn btn-warning">Edit</a>
<form action="{{ route('coaches.destroy', $coach) }}" method="POST" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this coach?')">Delete</button>
</form>
@endsection
