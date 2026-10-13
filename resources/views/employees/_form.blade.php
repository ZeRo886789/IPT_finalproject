@php($employee = $employee ?? null)
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Employee Code <span class="text-muted">(auto if blank)</span></label>
        <input type="text" name="employee_code" class="form-control @error('employee_code') is-invalid @enderror"
               value="{{ old('employee_code', $employee->employee_code ?? '') }}" placeholder="Auto-generated if blank">
        @error('employee_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Full Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $employee->name ?? '') }}" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Role <span class="text-danger">*</span></label>
        <select name="role" class="form-select @error('role') is-invalid @enderror" required>
            <option value="">Select role</option>
            @foreach(['Tailor','Master Tailor','Cutter','Seamstress','Cashier','Manager'] as $role)
                <option value="{{ $role }}" {{ old('role', $employee->role ?? '') === $role ? 'selected' : '' }}>{{ $role }}</option>
            @endforeach
        </select>
        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Phone <span class="text-danger">*</span></label>
        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
               value="{{ old('phone', $employee->phone ?? '') }}" required>
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $employee->email ?? '') }}">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Hire Date</label>
        <input type="date" name="hire_date" class="form-control @error('hire_date') is-invalid @enderror"
               value="{{ old('hire_date', isset($employee) && $employee->hire_date ? $employee->hire_date->format('Y-m-d') : '') }}">
        @error('hire_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Status <span class="text-danger">*</span></label>
        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
            @foreach(['Active','Inactive'] as $s)
                <option value="{{ $s }}" {{ old('status', $employee->status ?? 'Active') === $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
<div class="form-actions">
    <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary cancel">Cancel</a>
    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
</div>
