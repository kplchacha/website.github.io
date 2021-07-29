<div>
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="h4 text-muted fw-bold">Payment Methods</h1>

        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#upsert-payment-method-modal">Add
            Payment Method</button>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    @if (optional(Auth::user())->isAdmin())
                    <th>Amount</th>
                    @endif
                    <th>Action</th>
                </tr>
            </thead>
            @if ($paymentMethods->count())

            @foreach ($paymentMethods as $paymentMethod)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $paymentMethod->name }}</td>

                @if (optional(Auth::user())->isAdmin())
                <th>{{ $paymentMethod->payments()->sum('amount') }}</th>
                @endif
                <td>
                    <div class="d-inline-flex">
                        @can('update', $paymentMethod)
                        <button class="btn btn-sm btn-info">
                            <div wire:click="editPaymentMethod({{ $paymentMethod }})"
                                class="d-inline-flex align-items-center">
                                <i class="fa fa-edit"></i>
                                <span class="ms-1">Edit</span>
                            </div>
                        </button>
                        @endcan

                        @can('delete', $paymentMethod)
                        <button class="btn btn-sm btn-danger ms-2">
                            <div wire:click="showDeleteModal({{ $paymentMethod }})"
                                class="d-inline-flex align-items-center">
                                <i class="fa fa-trash-alt"></i>
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
                <td colspan="3">No payment methods added yet</td>
            </tr>

            @endif
            <tbody>
            </tbody>
        </table>
    </div>


    <x-modals.payments.methods.upsert :paymentMethodId="$paymentMethodId" />
    <x-modals.payments.methods.delete :name="$name" />
</div>

@push('scripts')
<script>
    livewire.on('hideUpsertPaymentMethodModal', () => $('#upsert-payment-method-modal').modal('hide'))
    livewire.on('showUpsertPaymentMethodModal', () => $('#upsert-payment-method-modal').modal('show'))
    livewire.on('hideDeletePaymentMethodModal', () => $('#delete-payment-method-modal').modal('hide'))
    livewire.on('showDeletePaymentMethodModal', () => $('#delete-payment-method-modal').modal('show'))
</script>
@endpush

@section('title', 'Admin Payment Methods')