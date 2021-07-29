@extends('layouts.base')

@section('content')
<header class="fixed-top shadow">
    <x-navbar />
</header>
<div class="h-screen">
    <div class="container h-100">
        <div class="d-flex flex-column pt-5 pt-md-0 flex-md-row align-items-center h-100">
            <div class="flex-grow-1 p-3">
                <h1><strong>About</strong></h1>
                <p class="fs-4">{{ config('app.name') }} is a web-based platform that can be used by real
                    estate agency to manage their properties, especially rental properties. It is designed keeping
                    in mind all spectrums of the real estate management
                    and all stakeholders in the businesses.
                </p>
            </div>
            <div class="col-md-6 px-sm-1 px-md-5">
                @guest

                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-text p-3">
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="form-floating">
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email">
                                    <label for="email">Email</label>
                                    @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-floating mt-3">
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Password">
                                    <label for="password">Password</label>
                                    @error('password')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-check mt-3">
                                    <input type="checkbox" class="form-check-input" name="remember_me" id="remember-me">
                                    <label for="remember-me" class="form-check-label">Remember Me</label>
                                </div>
                                <div class="mt-3">

                                    <button class="btn w-100 btn-dark">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection

@push('modals')
<x-modals.logout />
@endpush