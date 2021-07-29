@props(['paymentId','paymentMethods'])

<div wire:ignore.self class="modal fade" id="upsert-payment-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @if (boolval($paymentId))
                <h5 class="modal-title">Edit Payment</h5>
                @else
                <h5 class="modal-title">Add Payment</h5>
                @endif
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div>
                    <label for="paymentMethod" class="fw-bold form-label">Payment Method</label>
                    <select wire:model.lazy="payment_method_id" id="paymentMethod"
                        class="form-select @error('payment_method_id') is-invalid @enderror">
                        <option value="" selected>Select Payment Method...</option>

                        @foreach ($paymentMethods as $paymentMethod)
                        <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                        @endforeach
                    </select>
                    @error('payment_method_id')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="amount" class="fw-bold form-label">Amount</label>
                    <input type="number" step="0.01" wire:model.lazy="amount" id="amount"
                        class="form-control @error('amount') is-invalid @enderror">
                    @error('amount')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="description" class="fw-bold form-label">Description</label>
                    <textarea wire:model.lazy="description" id="description" rows="3"
                        class="form-control @error('description') is-invalid @enderror"></textarea>
                    @error('description')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>

                @if (boolval($paymentId))
                <button wire:click="updatePayment" class="btn btn-dark">Update</button>
                @else
                <button wire:click="createPayment" class="btn btn-dark">Submit</button>
                @endif
            </div>
        </div>
    </div>
</div>