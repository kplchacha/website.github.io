@props(['label'])

<div class="modal fade" id="delete-room-modal" tabindex="-1" aria-labelledby="deleteRoomTitle"
    aria-hidden="true">
    <div class="modal-dialog">
        <form wire:submit.prevent="deleteRoom" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRoomTitle">
                    Delete Room
                </h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the room labelled <b>{{ $label }}</b> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </form>
    </div>
</div>