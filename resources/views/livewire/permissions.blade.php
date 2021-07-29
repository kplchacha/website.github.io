<div>
    <h4><strong>Permissions</strong></h4>

    <div class="table-responsive">
        <table class="table table-light table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @if ($permissions->count())
                @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $permission->title }}</td>
                    <td>{{ $permission->roles()->count() }}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button wire:click="editPermission({{ $permission }})"
                                class="btn btn-sm btn-info d-flex align-items-center ms-2">
                                <i class="fa fa-edit"></i>
                                <span class="ms-2">Edit</span>
                            </button>
                            <button wire:click="showDeletePermission({{ $permission }})"
                                class="btn btn-sm btn-danger d-flex align-items-center ms-2">
                                <i class="fa fa-trash-alt"></i>
                                <span class="ms-2">Delete</span>
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
                    <td colspan="4">{{ $permissions->links() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <x-modals.permissions.edit :permissionId="$permissionId" />
    <x-modals.permissions.delete :title="$title" />

</div>

@section('title', 'Admin Permissions')

@push('scripts')
    <script>
        livewire.on('showEditPermissionModal', () => $('#edit-permission-modal').modal('show'));
        livewire.on('closeEditPermissionModal', () => $('#edit-permission-modal').modal('hide'));
        livewire.on('showPermissionDeletionModal', () => $('#delete-permission-confirmation-modal').modal('show'));
        livewire.on('closePermissionDeletionModal', () => $('#delete-permission-confirmation-modal').modal('hide'));
    </script>
@endpush