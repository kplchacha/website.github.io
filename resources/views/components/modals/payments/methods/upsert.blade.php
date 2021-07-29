@props(['paymentMethodId'])

<div wire:ignore.self class="modal fade" id="upsert-payment-method-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                @if (boolval($paymentMethodId))
                <h5 class="modal-title fw-bold">Edit Payment Method</h5>
                @else
                <h5 class="modal-title fw-bold">Add Payment Method</h5>
                @endif
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div>
                    <label for="name" class="fw-bold">Name</label>
                    <input type="text" wire:model.lazy="name" id="name"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                @if (boolval($paymentMethodId))
                <button wire:click="updatePaymentMethod" class="btn btn-primary">Update</button>
                @else
                <button wire:click="createPaymentMethod" class="btn btn-primary">Submit</button>
                @endif
            </div>
        </div>
    </div>
</div>