@props(['title'])

<div wire:ignore.self class="modal fade" id="delete-role-confirmation-modal" tabindex="-1" aria-labelledby="deleteRoleConfirmationTitle"
    aria-hidden="true">
    <div class="modal-dialog">
        <form wire:submit.prevent="destroyRole" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRoleConfirmationTitle">
                    Deleting Role
                </h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the role <b>{{ $title }}?</b> All its users won't have priviledge they have currently.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </form>
    </div>
</div>