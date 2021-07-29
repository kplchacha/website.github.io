@props(['name'])

<div class="modal fade" id="delete-property-modal" tabindex="-1" aria-labelledby="deletePropertyTitle"
    aria-hidden="true">
    <div class="modal-dialog">
        <form wire:submit.prevent="deleteProperty" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePropertyTitle">
                    Deleting Property
                </h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the property <b>{{ $name }}</b> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nevermind</button>
                <button class="btn btn-danger">Sure</button>
            </div>
        </form>
    </div>
</div>