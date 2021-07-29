@props(['roleId' => null, 'permissions' => []])

<div wire:ignore.self class="modal fade" id="upsert-role-modal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" role="form" aria-labelledby="addRoleModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoleModalLabel">
                    @if ($roleId)
                    <span>Update Role</span>
                    @else
                    <span>Add Role</span>
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <label for="title" class="fw-bold">Title <span class="text-danger">*</span></label>
                    <input type="text" id="title" wire:model.lazy="title"
                        class="form-control @error('title') is-invalid @enderror mt-1" @if(!is_null($roleId)) disabled
                        @endif)>
                    @error('title')
                    <span class="invalid-feedback">
                        <strong>
                            {{ $message }}
                        </strong>
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
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
                <div class="mt-3">
                    <label for="permissions" class="fw-bold">Permissions</label>
                    <select name="permissions" wire:model="permissions" id="permissions" class="form-select" multiple>
                        @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->title }}</option>
                        @endforeach
                    </select>
                    @error('permissions')
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

                @if ($roleId)
                <button type="button" class="btn btn-info" wire:click="updateRole">Update</button>
                @else
                <button type="button" class="btn btn-primary" wire:click="createRole">Submit</button>
                @endif
            </div>
        </div>
    </div>
</div>