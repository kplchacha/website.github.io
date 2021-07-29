@extends('layouts.base')

@section('content')
<header>
    <x-navbar />
</header>

<main>
    @yield('main')
</main>
@endsection

@push('modals')
<x-modals.logout />
@endpush