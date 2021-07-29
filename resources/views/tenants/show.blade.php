@extends('layouts.dashboard')

@section('section')
<div>
    <h1 class="h4 text-muted fw-bold">{{ $roomUser->user->name }}</h1>
</div>

<div>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a href="" class="nav-link active" aria-current="page" id="details-tab" data-bs-toggle="tab"
                data-bs-target="#details" role="tab" aria-controls="details" aria-selected="true">Details</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments" role="tab"
                aria-controls="payments" aria-selected="false">Payments</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active p-4" id="details" role="tabpanel" aria-labelledby="details-tab">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="text-secondary">Tenant Details</h5>
                    <p class="text-muted">Information about the tenant</p>
                </div>
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-text pb-3">

                                    <div class="row mt-3">
                                        <span class="col-md-4 fw-bold text-secondary">Name</span>
                                        <span class="col-md-8 text-primary">{{ $roomUser->user->name }}</span>
                                    </div>

                                    <div class="row mt-3">
                                        <span class="col-md-4 fw-bold text-secondary">Phone</span>
                                        <span class="col-md-8 text-primary">{{ $roomUser->user->phone }}</span>
                                    </div>

                                    <div class="row mt-3">
                                        <span class="col-md-4 fw-bold text-secondary">Email</span>
                                        <span class="col-md-8 text-primary">{{ $roomUser->user->email }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-4">
                    <h5 class="text-secondary">Tenureship Details</h5>
                    <p class="text-muted">Information about the tenancy</p>
                </div>
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-text pb-3">

                                    <div class="row mt-3">
                                        <span class="col-md-4 fw-bold text-secondary">Room</span>
                                        <span class="col-md-8 text-primary">{{ $roomUser->room->label }}</span>
                                    </div>

                                    <div class="row mt-3">
                                        <span class="col-md-4 fw-bold text-secondary">Since</span>
                                        <span
                                            class="col-md-8 text-primary">{{ $roomUser->created_at->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade p-4" id="payments" role="tabpanel" aria-labelledby="payments-tab">
            <livewire:payments :roomUser="$roomUser" />
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        livewire.on('hideUpsertPaymentModal', () => $('#upsert-payment-modal').modal('hide'));
        livewire.on('showUpsertPaymentModal', () => $('#upsert-payment-modal').modal('show'));
        livewire.on('showDeletePaymentModal', () => $('#delete-payment-modal').modal('show'));
        livewire.on('hideDeletePaymentModal', () => $('#delete-payment-modal').modal('hide'));
    </script>
@endpush