@extends('layouts.app')

@section('content')
<h1>Coaches</h1>
<a href="{{ route('coaches.create') }}" class="btn btn-primary mb-3">Add New Coach</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Experience</th>
            <th>Specialization</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($coaches as $coach)
        <tr>
            <td>{{ $coach->coach_id }}</td>
            <td>{{ $coach->coach_name }}</td>
            <td>{{ $coach->contact_no }}</td>
            <td>{{ $coach->experience_year }}</td>
            <td>{{ $coach->specialization }}</td>
            <td>
                <a href="{{ route('coaches.edit', $coach) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('coaches.destroy', $coach) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this coach?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection