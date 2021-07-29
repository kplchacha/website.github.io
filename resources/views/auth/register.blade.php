@extends('layouts.base')

@section('title', 'Register')

@section('content')

<main>

    <div class="container">
        <div class="min-h-screen row justify-content-center align-items-center">
            <div class="col-12 col-sm-9 col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <div class="text-center">
                                <h3 class="text-center">Register</h3>
                                <hr>
                                <h4 class="h6">Already Have an Account ? <a href="{{ route('login') }}">Login</a></h4>
                            </div>

                            <form class="needs-validation" action="{{ route('register') }}" method="post">
                                @csrf

                                <div class="container-fluid">
                                    <div class="row g-3">

                                        <div>
                                            <label class="fw-bold form-label" for="name">Name</label>
                                            <input class="form-control @error('name') is-invalid @enderror" type="text"
                                                name="name" id="name" placeholder="Name..." value="{{ old('name') }}" />
                                            @error('name')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="fw-bold form-label" for="email">Email Address</label>
                                            <input class="form-control @error('email') is-invalid @enderror"
                                                type="email" name="email" id="email" placeholder="Email Address..."
                                                value="{{ old('email') }}" />
                                            @error('email')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="fw-bold form-label" for="phone">Phone Number</label>
                                            <input class="form-control @error('phone') is-invalid @enderror" type="tel"
                                                name="phone" id="phone" placeholder="Phone Number..."
                                                value="{{ old('phone') }}" />
                                            @error('phone')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="fw-bold form-label" for="password">Password</label>
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                type="password" id="password" name="password"
                                                placeholder="Password..." />
                                            @error('password')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="fw-bold form-label" for="password-confirmation">Confirm
                                                Password</label>
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                type="password" id="password-confirmation" name="password_confirmation"
                                                placeholder="Password..." />
                                        </div>

                                        <div class="mt-3 col-md-12">
                                            <button class="btn d-block w-100 btn-dark">Sign Up</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection