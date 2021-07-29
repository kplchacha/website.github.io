@extends('layouts.base')

@section('content')
<main class="d-flex h-screen bg-light" x-data="{ showSidebar: false, mainArea: true }">
    <section x-show="showSidebar" class="col-12 col-md-3 col-lg-2 bg-dark p-2 d-md-block overflow-auto">
        <div class="d-flex justify-content-end">
            <button x-on:click="showSidebar = false; mainArea = true" class="btn btn-light d-md-none">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <ul class="navbar-nav px-3">
            <li class="nav-item py-2">
                <a href="{{ route('dashboard') }}" class="nav-link text-white-50">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="ms-2">Dashboard</span>
                </a>
            </li>

            @can('viewAny', \App\Models\Role::class)
            <hr class="my-0 bg-light">
            <li class="nav-item py-2">
                <a href="{{ route('roles.index') }}" class="nav-link text-white-50">
                    <i class="fas fa-user-cog"></i>
                    <span class="ms-2">Roles</span>
                </a>
            </li>
            @endcan

            @can('viewAny', \App\Models\Permission::class)
            <hr class="my-0 bg-light">
            <li class="nav-item py-2">
                <a href="{{ route('permissions.index') }}" class="nav-link text-white-50">
                    <i class="fas fa-user-cog"></i>
                    <span class="ms-2">Permissions</span>
                </a>
            </li>
            @endcan

            @can('viewAny', \App\Models\User::class)
            <hr class="my-0 bg-light">
            <li class="nav-item py-2">
                <a href="{{ route('users.index') }}" class="nav-link text-white-50">
                    <i class="fas fa-users"></i>
                    <span class="ms-2">Users</span>
                </a>
            </li>
            @endcan

            @can('viewAny', \App\Models\PaymentMethod::class)
            <hr class="my-0 bg-light">
            <li class="nav-item py-2">
                <a href="{{ route('payment-methods.index') }}" class="nav-link text-white-50">
                    <i class="fas fa-credit-card"></i>
                    <span class="ms-2">Payment Methods</span>
                </a>
            </li>
            @endcan

            @can('viewAny', \App\Models\Property::class)
            <hr class="my-0 bg-light">
            <li class="nav-item py-2">
                <a href="{{ route('properties.index') }}" class="nav-link text-white-50">
                    <i class="fas fa-building"></i>
                    <span class="ms-2">Properties</span>
                </a>
            </li>
            @endcan
        </ul>
    </section>

    <section x-show="mainArea" class="overflow-auto position-relative flex-grow-1 bg-light">
        <nav class="navbar navbar-light fixed-top bg-white position-absolute shadow-sm">
            <div class="container">
                <button x-on:click="showSidebar = true, mainArea = false" class="btn btn-outline-primary d-md-none">
                    <i class="fa fa-bars"></i>
                </button>

                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logout-modal">Logout</button>
                <a href="{{ route('welcome') }}" class="btn btn-primary">Frontend</a>
            </div>
        </nav>

        <div class="p-3 mt-nav">
            @yield('section')
        </div>

    </section>
</main>
@endsection

@push('modals')
<x-modals.logout />
@endpush