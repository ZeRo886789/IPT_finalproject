@php($measurement = $measurement ?? null)
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Customer <span class="text-danger">*</span></label>
        <select name="customer_id" class="form-select @error('customer_id') is-invalid @enderror" required>
            <option value="">Select customer</option>
            @foreach($customers as $c)
                <option value="{{ $c->id }}" {{ (string) old('customer_id', request('customer_id', $measurement->customer_id ?? '')) === (string) $c->id ? 'selected' : '' }}>{{ $c->name }} · {{ $c->customer_code }}</option>
            @endforeach
        </select>
        @error('customer_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Linked Order</label>
        <select name="clothing_order_id" class="form-select @error('clothing_order_id') is-invalid @enderror">
            <option value="">General customer measurement</option>
            @foreach($orders as $o)
                <option value="{{ $o->id }}" {{ (string) old('clothing_order_id', request('order_id', $measurement->clothing_order_id ?? '')) === (string) $o->id ? 'selected' : '' }}>{{ $o->order_code }} · {{ $o->customer->name }}</option>
            @endforeach
        </select>
        @error('clothing_order_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Unit <span class="text-danger">*</span></label>
        <select name="unit" class="form-select @error('unit') is-invalid @enderror">
            <option value="in" {{ old('unit', $measurement->unit ?? 'in') === 'in' ? 'selected' : '' }}>in</option>
            <option value="cm" {{ old('unit', $measurement->unit ?? '') === 'cm' ? 'selected' : '' }}>cm</option>
        </select>
        @error('unit') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    @foreach(['chest'=>'Chest','waist'=>'Waist','hip'=>'Hip','shoulder'=>'Shoulder','sleeve'=>'Sleeve','neck'=>'Neck','length'=>'Length'] as $field => $label)
    <div class="col-md-3 col-6">
        <label class="form-label">{{ $label }}</label>
        <input type="number" step="0.01" min="0" name="{{ $field }}"
               class="form-control @error($field) is-invalid @enderror"
               value="{{ old($field, $measurement->$field ?? '') }}" placeholder="{{ $measurement->unit ?? 'in' }}">
        @error($field) <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    @endforeach
    <div class="col-12">
        <label class="form-label">Notes</label>
        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes', $measurement->notes ?? '') }}</textarea>
        @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
<div class="form-actions">
    <a href="{{ route('measurements.index') }}" class="btn btn-ghost border-secondary cancel">Cancel</a>
    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
</div>
