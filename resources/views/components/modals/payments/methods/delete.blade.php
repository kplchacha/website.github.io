@props(['name'])

<div class="modal fade" id="delete-payment-method-modal" tabindex="-1" aria-labelledby="deletePaymentMethodTitle"
    aria-hidden="true">
    <div class="modal-dialog">
        <form wire:submit.prevent="deletePaymentMethod" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePaymentMethodTitle">
                    Deleting Payment Method
                </h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the payment method <b>{{ $name }}</b> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nevermind</button>
                <button class="btn btn-danger">Sure</button>
            </div>
        </form>
    </div>
</div>