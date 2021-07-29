@props(['permissionId' => null])

<div wire:ignore.self class="modal fade" id="edit-permission-modal" tabindex="-1" role="form"
    aria-labelledby="editPermissionModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPermissionModalLabel">
                    <span>Edit Permission</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <label for="title" class="fw-bold">Title <span class="text-danger">*</span></label>
                    <input type="text" id="title" wire:model.lazy="title"
                        class="form-control @error('title') is-invalid @enderror mt-1" disabled>
                    @error('title')
                    <span class="invalid-feedback">
                        <strong>
                            {{ $message }}
                        </strong>
                    </span>
                    @enderror
                </div>
                <div>
                    <label for="description" class="fw-bold">Description <span
                            class="text-muted">(Optional)</span></label>
                    <textarea id="description" wire:model.lazy="description"
                        class="form-control @error('description') is-invalid @enderror mt-1"></textarea>
                    @error('description')
                    <span class="invalid-feedback">
                        <strong>
                            {{ $message }}
                        </strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-info" wire:click="updatePermission">Update</button>
            </div>
        </div>
    </div>
</div>