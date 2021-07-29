@extends('layouts.dashboard')

@section('section')

<div>
    <h1 class="h4 fw-bold text-muted">{{ $property->name }}</h1>
</div>

<div class="mt-3">
    <ul class="nav nav-tabs nav-fill" id="property-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" href="#details"
                role="tab" aria-controls="details" aria-selected="true">Details</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="rooms-tab" data-bs-toggle="tab" data-bs-target="#rooms" href="#rooms" role="tab"
                aria-controls="rooms" aria-selected="true">Rooms</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tenants-tab" data-bs-toggle="tab" data-bs-target="#tenants" href="#tenants"
                role="tab" aria-controls="tenants" aria-selected="true">Tenants</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active p-4" id="details" role="tabpanel" aria-labelledby="details-tab">

            <div class="row">
                <div class="col-md-4">
                    <h5 class="text-secondary">Property Details</h5>
                    <p class="text-muted">Basic Property Details</p>
                </div>
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-text py-3">
                                    <div class="row">
                                        <span class="col-md-4 fw-bold text-secondary">Name</span>
                                        <span class="col-md-8 text-primary">{{ $property->name }}</span>
                                    </div>
                                    <div class="row mt-3">
                                        <span class="col-md-4 fw-bold text-secondary">Description</span>
                                        <span class="col-md-8 text-primary">{{ $property->description }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-4">
                    <h5 class="text-secondary">Location Details</h5>
                    <p class="text-muted">Where the property is located</p>
                </div>
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-text pb-3">

                                    @if (boolval($property->location))
                                    @foreach ($property->location as $key => $value)
                                    <div class="row mt-3">
                                        <span class="col-md-4 fw-bold text-secondary">{{ $key }}</span>
                                        <span class="col-md-8 text-primary">{{ $value }}</span>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="mt-3 fw-bold">
                                        Location details not available
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-md-4">
                    <h5 class="text-secondary">Ower Details</h5>
                    <p class="text-muted">Information about the property</p>
                </div>
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-text pb-3">

                                    <div class="row mt-3">
                                        <span class="col-md-4 fw-bold text-secondary">Name</span>
                                        <span class="col-md-8 text-primary">{{ $property->user->name }}</span>
                                    </div>

                                    <div class="row mt-3">
                                        <span class="col-md-4 fw-bold text-secondary">Phone</span>
                                        <span class="col-md-8 text-primary">{{ $property->user->phone }}</span>
                                    </div>

                                    <div class="row mt-3">
                                        <span class="col-md-4 fw-bold text-secondary">Email</span>
                                        <span class="col-md-8 text-primary">{{ $property->user->email }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade p-3" id="rooms" role="tabpanel" aria-labelledby="rooms-tab">
            
            <livewire:rooms :property="$property" />

        </div>
        <div class="tab-pane fade" id="tenants" role="tabpanel" aria-labelledby="tenants-tab">
            <livewire:tenancies :property="$property" />
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>

        livewire.on('showUpsertRoomModal', () => $('#upsert-room-modal').modal('show'))
        livewire.on('hideUpsertRoomModal', () => $('#upsert-room-modal').modal('hide'))

        livewire.on('showDeleteRoomModal', () => $('#delete-room-modal').modal('show'))
        livewire.on('hideDeleteRoomModal', () => $('#delete-room-modal').modal('hide'))

        livewire.on('showLetRoomModal', () => $('#let-room-modal').modal('show'))
        livewire.on('hideLetRoomModal', () => $('#let-room-modal').modal('hide'))

        livewire.on('showRevokeTenancyModal', () => $('#revoke-tenancy-modal').modal('show'))
        livewire.on('hideRevokeTenancyModal', () => $('#revoke-tenancy-modal').modal('hide'))

    </script>
@endpush