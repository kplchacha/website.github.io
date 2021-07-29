@props(['title'])

<div class="modal fade" id="delete-permission-confirmation-modal" tabindex="-1" aria-labelledby="deletePermissionConfirmationTitle"
    aria-hidden="true">
    <div class="modal-dialog">
        <form wire:submit.prevent="deletePermission" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePermissionConfirmationTitle">
                    Deleting Permission
                </h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the permission <b>{{ $title }}</b> ? All its role won't have the priviledge again.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nevermind</button>
                <button class="btn btn-danger">Sure</button>
            </div>
        </form>
    </div>
</div>