@props(['roles' => [], 'userId' => null])

<div wire:ignore.self class="modal fade" id="upsert-user-modal" tabindex="-1" role="form"
    aria-labelledby="upsertUserModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                @if (is_null($userId))
                <h5 class="modal-title" id="upsertUserModalLabel">Add User</h5>
                @else
                <h5 class="modal-title" id="upsertUserModalLabel">Edit User</h5>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="container-fluid">
                    <div class="row g-3">
                        <div class="form-floating col-md-8">
                            <input type="text" wire:model.lazy="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                            <label for="name">Name</label>
                            @error('name')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-floating col-md-6">
                            <input type="email" wire:model.lazy="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                            <label for="email">Email</label>
                            @error('email')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-floating col-md-6">
                            <input type="tel" wire:model.lazy="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror" placeholder="Phone">
                            <label for="name">Phone</label>
                            @error('phone')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-floating col-md-12">
                            <select wire:model="role_id" id="role"
                                class="form-select @error('role_id') is-invalid @enderror">
                                <option value="" selected>Select Role</option>

                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->title }}
                                </option>
                                @endforeach
                            </select>
                            <label for="role">Role</label>
                            @error('role_id')
                            <span class="invalid-feedback">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-floating col-md-9">
                            <input type="password" wire:model.lazy="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                            <label for="name">Password</label>
                            @error('password')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                @if (is_null($userId))
                <button type="button" class="btn btn-dark" wire:click="create">Submit</button>
                @else
                <button type="button" class="btn btn-dark" wire:click="update">Update</button>
                @endif
            </div>
        </div>
    </div>
</div>