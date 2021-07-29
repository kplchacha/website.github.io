@extends('layouts.app')

@section('title', Auth::user()->name . " Payments")

@section('main')
<div class="container">
    <div class="d-flex justify-content-between align-items-center py-3">
        <h1 class="h4"> {{ Auth::user()->name }} Payments</h1>

        <a href="{{ route('user.payments.print') }}" class="btn btn-dark">
            <div class="d-inline-flex">
                <span><i class="fa fa-print"></i></span>
                <span class="ms-2">Print</span>
            </div>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Description</th>
                    <th>Payment Date</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="5">{{ $payments->links() }}</td>
                </tr>
            </tfoot>
            <tbody>
                @if ($payments->count())
                @foreach ($payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->paymentMethod->name }}</td>
                    <td>{{ $payment->description }}</td>
                    <td>{{ $payment->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5">No payments sent or received yet</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection