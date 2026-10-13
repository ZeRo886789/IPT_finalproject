@php($order = $order ?? null)
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Order Code <span class="text-muted">(auto if blank)</span></label>
        <input type="text" name="order_code" class="form-control @error('order_code') is-invalid @enderror"
               value="{{ old('order_code', $order->order_code ?? '') }}" placeholder="Auto-generated if blank">
        @error('order_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Customer <span class="text-danger">*</span></label>
        <select name="customer_id" class="form-select @error('customer_id') is-invalid @enderror" required>
            <option value="">Select customer</option>
            @foreach($customers as $c)
                <option value="{{ $c->id }}" {{ (string) old('customer_id', request('customer_id', $order->customer_id ?? '')) === (string) $c->id ? 'selected' : '' }}>{{ $c->name }} · {{ $c->customer_code }}</option>
            @endforeach
        </select>
        @error('customer_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Assigned Employee</label>
        <select name="employee_id" class="form-select @error('employee_id') is-invalid @enderror">
            <option value="">Unassigned</option>
            @foreach($employees as $e)
                <option value="{{ $e->id }}" {{ (string) old('employee_id', $order->employee_id ?? '') === (string) $e->id ? 'selected' : '' }}>{{ $e->name }} · {{ $e->role }}</option>
            @endforeach
        </select>
        @error('employee_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Garment Type <span class="text-danger">*</span></label>
        <select name="garment_type" class="form-select @error('garment_type') is-invalid @enderror" required>
            <option value="">Select garment</option>
            @foreach(['Barong','Barong Tagalog','School Uniform','Pants','Skirt','Blouse','Dress','Suit','Coat','Alteration','Other'] as $g)
                <option value="{{ $g }}" {{ old('garment_type', $order->garment_type ?? '') === $g ? 'selected' : '' }}>{{ $g }}</option>
            @endforeach
        </select>
        @error('garment_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Fabric</label>
        <input type="text" name="fabric" class="form-control @error('fabric') is-invalid @enderror" value="{{ old('fabric', $order->fabric ?? '') }}" placeholder="e.g. Linen, Cotton">
        @error('fabric') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Color</label>
        <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" value="{{ old('color', $order->color ?? '') }}" placeholder="e.g. Cream">
        @error('color') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Size</label>
        <input type="text" name="size" class="form-control @error('size') is-invalid @enderror" value="{{ old('size', $order->size ?? '') }}" placeholder="e.g. Custom / L">
        @error('size') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Total Amount (₱) <span class="text-danger">*</span></label>
        <input type="number" step="0.01" min="0" name="total_amount" class="form-control @error('total_amount') is-invalid @enderror" value="{{ old('total_amount', $order->total_amount ?? 0) }}" required>
        @error('total_amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Order Date <span class="text-danger">*</span></label>
        <input type="date" name="order_date" class="form-control @error('order_date') is-invalid @enderror" value="{{ old('order_date', isset($order) && $order->order_date ? $order->order_date->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
        @error('order_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Due Date</label>
        <input type="date" name="due_date" class="form-control @error('due_date') is-invalid @enderror" value="{{ old('due_date', isset($order) && $order->due_date ? $order->due_date->format('Y-m-d') : '') }}">
        @error('due_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Status <span class="text-danger">*</span></label>
        <select name="status" class="form-select @error('status') is-invalid @enderror">
            @foreach(['Pending','In Progress','Ready','Completed','Cancelled'] as $s)
                <option value="{{ $s }}" {{ old('status', $order->status ?? 'Pending') === $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-12">
        <label class="form-label">Special Instructions</label>
        <textarea name="special_instructions" class="form-control @error('special_instructions') is-invalid @enderror" rows="3" placeholder="Style requests, fabric instructions, fitting notes…">{{ old('special_instructions', $order->special_instructions ?? '') }}</textarea>
        @error('special_instructions') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
<div class="form-actions">
    <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary cancel">Cancel</a>
    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
</div>
