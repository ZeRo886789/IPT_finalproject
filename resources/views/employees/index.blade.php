@extends('layouts.app')
@section('title','Employees · TailorDesk')
@section('page-title','Employees')
@section('content')
<div class="page-head">
    <div class="lead">Tailors, cutters, cashiers and shop staff.</div>
    <a href="{{ route('employees.create') }}" class="btn btn-primary">＋ Add Employee</a>
</div>

<form class="filter-bar" method="GET" action="{{ route('employees.index') }}">
    <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Search name, code or role…">
    <button type="submit" class="btn btn-outline-secondary">Search</button>
    @if($q) <a href="{{ route('employees.index') }}" class="btn btn-ghost">Clear</a> @endif
</form>

<div class="panel table-panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Code</th><th>Employee</th><th>Role</th><th>Phone</th><th>Status</th><th>Orders</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
            @forelse($employees as $employee)
                <tr>
                    <td><span class="code">{{ $employee->employee_code }}</span></td>
                    <td><a href="{{ route('employees.show', $employee) }}" class="strong-link">{{ $employee->name }}</a></td>
                    <td>{{ $employee->role }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td><span class="status {{ $employee->status === 'Active' ? 'status-completed' : 'status-cancelled' }}">{{ $employee->status }}</span></td>
                    <td><span class="count-badge">{{ $employee->orders_count }}</span></td>
                    <td class="actions text-end">
                        <a href="{{ route('employees.show', $employee) }}" class="text-wine">View</a>
                        <a href="{{ route('employees.edit', $employee) }}" class="text-wine">Edit</a>
                        <form method="POST" action="{{ route('employees.destroy', $employee) }}" class="d-inline" onsubmit="return confirm('Delete this employee?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-danger btn-link">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="empty">No employees found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">
        {{ $employees->onEachSide(1)->links('partials.pagination') }}
    </div>
</div>
@endsection
