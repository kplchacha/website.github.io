@extends('layouts.base')

@section('title', 'Login')

@section('content')

<main class="">

    <div class="container">
        <div class="min-h-screen row justify-content-center align-items-center">
            <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <div class="text-center">
                                <h3 class="text-center">Login</h3>
                                <hr>
                                <h4 class="h6">Not a member yet ? <a href="{{ route('register') }}">Register</a></h4>
                            </div>

                            <form class="needs-validation" action="{{ route('login') }}" method="post">
                                @csrf
                                <div>
                                    <label class="fw-bold form-label" for="email">Email Address</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email"
                                        name="email" id="email" placeholder="Email Address..."
                                        value="{{ old('email') }}" />
                                    @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <label class="fw-bold form-label" for="password">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                        name="password" placeholder="Password" />
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
                                    <button class="btn d-block w-100 btn-dark">Sign In</button>
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