@props(['roles' => [], 'name' => null, 'role_id' => null])

<div wire:ignore.self class="modal fade" id="change-role-modal" tabindex="-1" role="form"
    aria-labelledby="changeRoleModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeRoleModalLabel">
                    <span>change Role</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Change role for the user <b>{{ $name }}</b></p>
                <div class="mt-3">
                    <label for="role" class="fw-bold">Role</label>
                    <select wire:model="role_id" id="role" class="form-select @error('role_id') is-invalid @enderror">
                        <option value="" selected>Select Role</option>

                        @foreach ($roles as $role)
                        <option {{ $role_id == $role->id ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->title }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
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
                <button type="button" class="btn btn-info" wire:click="changeUserRole">Update</button>
            </div>
        </div>
    </div>
</div>