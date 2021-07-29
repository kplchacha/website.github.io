<div>

    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold">Users</h4>
        <button data-bs-toggle="modal" data-bs-target="#upsert-user-modal" class="btn btn-dark">Add User</button>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @if ($users->count())
                @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->role->title }}</td>
                    <td>
                        <div class="d-flex justify-content-around align-items-center">
                            <button wire:click="edit({{ $user }})" class="btn btn-sm btn-primary">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-edit"></i>
                                    <span class="ms-2">Edit</span>
                                </div>
                            </button>
                            <button wire:click="showDeleteUserModal({{ $user }})" class="btn btn-sm btn-danger">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-trash-alt"></i>
                                    <span class="ms-2">Delete</span>
                                </div>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">{{ $users->links() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <x-modals.users.upsert :roles="$roles" :userId="$userId" />
    <x-modals.users.delete :name="$name" />
    <x-modals.users.change-role :roles="$roles" :role_id="$role_id" :name="$name" />

</div>

@push('scripts')
<script>

    const upsertUserModal = new bootstrap.Modal(document.getElementById('upsert-user-modal'))

    livewire.on('showDeleteUserModal', () => $('#delete-user-modal').modal('show'))
    livewire.on('hideDeleteUserModal', () => $('#delete-user-modal').modal('hide'))
    livewire.on('showChangeRoleModal', () => $('#change-role-modal').modal('show'))
    livewire.on('hideChangeRoleModal', () => $('#change-role-modal').modal('hide'))

    livewire.on('show-upsert-user-modal', event => upsertUserModal.show())
    livewire.on('hide-upsert-user-modal', event => upsertUserModal.hide())

</script>
@endpush