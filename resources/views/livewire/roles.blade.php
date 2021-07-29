<div>
    <div class="d-flex justify-content-between">

        <h4><strong>Roles</strong></h4>

        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#upsert-role-modal">Add Role</button>
    </div>
    
    <div class="overflow-auto w-100">
        <table class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Permissions Count</th>
                    <th>Users Count</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @if ($roles->count())
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $role->title }}</td>
                    <td>{{ $role->permissions->count() }}</td>
                    <td>{{ $role->users->count() }}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('roles.users.index', $role) }}" class="btn btn-sm btn-dark">
                                <div class="d-inline-flex">
                                    <span><i class="fa fa-eye"></i></span>
                                    <span class="ms-1">Users</span>
                                </div>
                            </a>
                            <button wire:click="showRole({{ $role }})"
                                class="btn btn-sm btn-primary d-flex align-items-center ms-2">
                                <i class="fa fa-edit"></i>
                                <span class="ms-1">Edit</span>
                            </button>
                            <button wire:click="deleteRole({{ $role }})"
                                class="btn btn-sm btn-danger d-flex align-items-center ms-2">
                                <i class="fa fa-trash-alt"></i>
                                <span class="ms-1">Delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                @endif
            </tbody>
        </table>
    </div>

    <x-modals.roles.upsert :roleId="$roleId" :permissions="$dbPermissions" />
    <x-modals.roles.delete :title="$title" />
</div>

@push('scripts')
<script>
    livewire.on('closeUpsertRoleModal', () => $('#upsert-role-modal').modal('hide'))
    livewire.on('showUpsertRoleModal', () => $('#upsert-role-modal').modal('show'))
    livewire.on('showRoleDeletionModal', () => $('#delete-role-confirmation-modal').modal('show'))
    livewire.on('closeRoleDeletionModal', () => $('#delete-role-confirmation-modal').modal('hide'))
</script>
@endpush



@section('title', 'Admin Roles')