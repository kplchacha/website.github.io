@extends('layouts.base')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Amount</th>
            <th>Payment Method</th>
            <th>Date</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $payment->amount }}</td>
            <td>{{ $payment->paymentMethod->name }}</td>
            <td>{{ $payment->created_at->format('Y-m-d H:i:s') }}</td>
            <td>{{ $payment->description }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection