@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('section')
<h4 class="fw-bold text-dark">Dashboard</h4>
<div class="row g-3 mt-3">

    @can('viewAny', \App\Models\Property::class)
    <a href="{{ route('properties.index') }}" class="col-12 col-sm-6 col-md-4 col-lg-3 text-dark text-decoration-none">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-text p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Properties</h6>
                            <span class="fw-bold">{{ $propertiesCount }}</span>
                        </div>
                        <div class="text-dark">
                            <i class="fa fa-2x fa-building"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    @endcan

    @can('viewAny', \App\Models\User::class)
    <a href="{{ route('users.index') }}" class="col-12 col-sm-6 col-md-4 col-lg-3 text-dark text-decoration-none">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-text p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Users</h6>
                            <span class="fw-bold">{{ $usersCount }}</span>
                        </div>
                        <div class="text-dark">
                            <i class="fa fa-2x fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    @endcan

    @can('viewAny', \App\Models\Role::class)
    <a href="{{ route('roles.index') }}" class="col-12 col-sm-6 col-md-4 col-lg-3 text-dark text-decoration-none">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-text p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Roles</h6>
                            <span class="fw-bold">{{ $rolesCount }}</span>
                        </div>
                        <div class="text-dark">
                            <i class="fa fa-2x fa-users-cog"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>


    <a href="{{ route('roles.users.index', \App\Models\Role::firstOrCreate(['title' => 'Property Owner'])) }}"
        class="col-12 col-sm-6 col-md-4 col-lg-3 text-dark text-decoration-none">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-text p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Property Owners</h6>
                            <span class="fw-bold">{{ $propertyOwnersCount  }}</span>
                        </div>
                        <div class="text-dark">
                            <i class="fa fa-2x fa-users-cog"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>

    <a href="{{ route('roles.users.index', \App\Models\Role::firstOrCreate(['title' => 'Tenant'])) }}"
        class="col-12 col-sm-6 col-md-4 col-lg-3 text-dark text-decoration-none">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-text p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Tenants</h6>
                            <span class="fw-bold">{{ $tenantsCount }}</span>
                        </div>
                        <div class="text-dark">
                            <i class="fa fa-2x fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    @endcan

    @can('viewAny', \App\Models\Permission::class)
    <a href="{{ route('permissions.index') }}" class="col-12 col-sm-6 col-md-4 col-lg-3 text-dark text-decoration-none">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-text p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Permissions</h6>
                            <span class="fw-bold">{{ $permissionsCount }}</span>
                        </div>
                        <div class="text-dark">
                            <i class="fa fa-2x fa-users-cog"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    @endcan

    @can('viewAny', \App\Models\PaymentMethod::class)
    <a href="{{ route('payment-methods.index') }}"
        class="col-12 col-sm-6 col-md-4 col-lg-3 text-dark text-decoration-none">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-text p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Payment Methods</h6>
                            <span class="fw-bold">{{ $paymentMethodsCount }}</span>
                        </div>
                        <div class="text-dark">
                            <i class="fa fa-2x fa-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    @endcan
</div>
@endsection