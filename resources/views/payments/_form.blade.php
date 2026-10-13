@php($payment = $payment ?? null)
<div class="row g-3">
    <div class="col-12">
        <label class="form-label">Clothing Order <span class="text-danger">*</span></label>
        <select name="clothing_order_id" class="form-select @error('clothing_order_id') is-invalid @enderror" required>
            <option value="">Select order</option>
            @foreach($orders as $o)
                <option value="{{ $o->id }}" {{ (string) old('clothing_order_id', request('order_id', $payment->clothing_order_id ?? '')) === (string) $o->id ? 'selected' : '' }}>{{ $o->order_code }} · {{ $o->customer->name }} · ₱{{ number_format($o->total_amount, 2) }}</option>
            @endforeach
        </select>
        @error('clothing_order_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Payment Date <span class="text-danger">*</span></label>
        <input type="date" name="payment_date" class="form-control @error('payment_date') is-invalid @enderror" value="{{ old('payment_date', isset($payment) && $payment->payment_date ? $payment->payment_date->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
        @error('payment_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Amount (₱) <span class="text-danger">*</span></label>
        <input type="number" step="0.01" min="0.01" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount', $payment->amount ?? '') }}" required>
        @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Payment Method <span class="text-danger">*</span></label>
        <select name="payment_method" class="form-select @error('payment_method') is-invalid @enderror">
            @foreach(['Cash','GCash','Bank Transfer','Card'] as $method)
                <option value="{{ $method }}" {{ old('payment_method', $payment->payment_method ?? 'Cash') === $method ? 'selected' : '' }}>{{ $method }}</option>
            @endforeach
        </select>
        @error('payment_method') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Status <span class="text-danger">*</span></label>
        <select name="status" class="form-select @error('status') is-invalid @enderror">
            @foreach(['Paid','Pending','Refunded'] as $st)
                <option value="{{ $st }}" {{ old('status', $payment->status ?? 'Paid') === $st ? 'selected' : '' }}>{{ $st }}</option>
            @endforeach
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-12">
        <label class="form-label">Reference No.</label>
        <input type="text" name="reference_no" class="form-control @error('reference_no') is-invalid @enderror" value="{{ old('reference_no', $payment->reference_no ?? '') }}" placeholder="GCash reference, receipt number, etc.">
        @error('reference_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-12">
        <label class="form-label">Notes</label>
        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes', $payment->notes ?? '') }}</textarea>
        @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
<div class="form-actions">
    <a href="{{ route('payments.index') }}" class="btn btn-ghost border-secondary cancel">Cancel</a>
    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
</div>
