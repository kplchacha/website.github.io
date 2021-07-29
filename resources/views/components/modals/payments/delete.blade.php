@props(['title'])

<div class="modal fade" id="delete-payment-modal" tabindex="-1"
    aria-labelledby="deletePaymentModal" aria-hidden="true">
    <div class="modal-dialog">
        <form wire:submit.prevent="deletePayment" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePaymentModal">
                    Deleting Payment
                </h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Deleting a payment means you made a fatal error, you might wanna try editing & updating the payment first</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nevermind</button>
                <button class="btn btn-danger">Sure</button>
            </div>
        </form>
    </div>
</div>