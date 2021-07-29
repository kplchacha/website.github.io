<div>
    <div class="d-flex justify-content-end">

        @can('create', \App\Models\Room::class)
        <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#upsert-room-modal">
            <div class="d-inline-flex">
                <span><i class="fa fa-plus"></i></span>
                <span class="ms-2">Room</span>
            </div>
        </button>
        @endcan
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Label</th>
                    <th>Cost</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @if (boolval($rooms->count()))

                @foreach ($rooms as $room)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $room->label }}</td>
                    <td>{{ $room->cost }}</td>
                    <td>{{ $room->description }}</td>
                    <td>{{ $room->occupied()  ? 'Occupied' : 'Not Occupied' }}</td>
                    <td>
                        <div class="d-inline-flex">
                            @can('let', $room)
                            <button wire:click="showLetRoomModal({{ $room }})"
                                class="btn btn-sm btn-dark {{ $room->occupied() ? 'disabled' : '' }}">Let</button>
                            @endcan

                            @can('update', $room)
                            <button wire:click="editRoom({{ $room }})" class="btn btn-sm btn-dark ms-2">Edit</button>
                            @endcan

                            @can('delete', $room)
                            <button wire:click="showDeleteRoomModal({{ $room }})"
                                class="btn btn-sm btn-danger ms-2">Delete</button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="6">No Rooms Added Yet</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <x-modals.rooms.upsert :roomId="$roomId" />
    <x-modals.rooms.delete :label="$label" />
    <x-modals.rooms.let :label="$label" :users="$users" />
</div>