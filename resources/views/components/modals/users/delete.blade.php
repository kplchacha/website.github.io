@props(['name'])

<div class="modal fade" id="delete-user-modal" tabindex="-1" aria-labelledby="deleteUserModalTitle"
    aria-hidden="true">
    <div class="modal-dialog">
        <form wire:submit.prevent="deleteUser" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalTitle">
                    Delete User
                </h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the user <b>{{ $name }}</b> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nevermind</button>
                <button class="btn btn-danger">Sure</button>
            </div>
        </form>
    </div>
</div>