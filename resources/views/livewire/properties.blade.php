<div>
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="h4 text-muted fw-bold">Propeties</h1>

        @can('create', \App\Models\Property::class)
        <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#upsert-property-modal">
            <div class="d-inline-flex">
                <span><i class="fa fa-plus"></i></span>
                <span class="ms-2">Property</span>
            </div>
        </button>
        @endcan
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Owner</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @if ($properties->count())
                @foreach ($properties as $property)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $property->name }}</td>
                    <td>{{ $property->user->name }}</td>
                    <td>
                        <div class="d-inline-flex">

                            @can('view', $property)
                            <a href="{{ route('properties.show', $property) }}" class="btn btn-sm btn-dark">
                                <div class="d-inline-flex">
                                    <span><i class="fa fa-eye"></i></span>
                                    <span class="ms-1">View</span>
                                </div>
                            </a>
                            @endcan

                            @can('update', $property)
                            <button wire:click="editProperty({{ $property }})" class="btn btn-sm btn-info ms-2">
                                <div class="d-inline-flex">
                                    <span><i class="fa fa-edit"></i></span>
                                    <span class="ms-1">Edit</span>
                                </div>
                            </button>
                            @endcan

                            @can('delete', $property)
                            <button wire:click="showDeleteProperty({{ $property }})" class="btn btn-sm btn-danger ms-2">
                                <div class="d-inline-flex">
                                    <span><i class="fa fa-trash-alt"></i></span>
                                    <span class="ms-1">Delete</span>
                                </div>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4">
                        No properties added yet
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <x-modals.properties.upsert :propertyId="$propertyId" :users="$users" :location="$location"
        :locationKeys="$locationKeys" />

    <x-modals.properties.delete :name="$name" />
</div>

@push('scripts')
<script>
    livewire.on('showUpsertPropertyModal', () => $('#upsert-property-modal').modal('show'))
    livewire.on('hideUpsertPropertyModal', () => $('#upsert-property-modal').modal('hide'))
    livewire.on('showDeletePropertyModal', () => $('#delete-property-modal').modal('show'))
    livewire.on('hideDeletePropertyModal', () => $('#delete-property-modal').modal('hide'))
</script>
@endpush

@section('title', 'Admin Properties')