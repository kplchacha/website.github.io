<div>

    <div class="d-flex justify-content-end">
        @can('create', \App\Models\Payment::class)
        <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#upsert-payment-modal">Add
            Payment</button>
        @endcan
    </div>

    <div class="table-responsive">
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>When</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @if ($roomUser->payments()->count())
                @foreach ($roomUser->payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->paymentMethod->name }}</td>
                    <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="d-inline-flex">
                            @can('update', $payment)
                            <button wire:click="editPayment({{ $payment }})" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i>
                            </button>
                            @endcan
                            @can('delete', $payment)
                            <button wire:click="showDeletePaymentModal({{ $payment }})"
                                class="btn btn-sm btn-danger ms-2">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5">No Payments Made Yet</td>
                </tr>
                @endif


            </tbody>

        </table>
    </div>

    <x-modals.payments.upsert :paymentMethods="$paymentMethods" :paymentId="$paymentId" />
    <x-modals.payments.delete />

</div>