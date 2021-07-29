<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-inline-flex">
                            <span>{{ Auth::user()->name }}</span>
                            <span class="ms-2"><i class="fa fs-5 fa-user"></i></span>
                        </div>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                        @can('access-dashboard')
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                            <div class="d-inline-flex">
                                <span><i class="fa fa-tachometer-alt"></i></span>
                                <span class="ms-2">Dashboard</span>
                            </div>
                        </a></li>
                        @endcan
                        <li><a class="dropdown-item" href="{{ route('user.payments') }}">
                            <div class="d-inline-flex">
                                <span><i class="fa fa-coins"></i></span>
                                <span class="ms-2">Payments</span>
                            </div>
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('messages.index') }}">
                            <div class="d-inline-flex">
                                <span><i class="fa fa-comments"></i></span>
                                <span class="ms-2">Messages</span>
                            </div>
                        </a></li>
                        <li><a class="dropdown-item" href="#" role="button" data-bs-toggle="modal"
                                data-bs-target="#logout-modal">
                                <div class="d-inline-flex">
                                    <span><i class="fa fa-sign-out-alt"></i></span>
                                    <span class="ms-2">Logout</span>
                                </div>
                            </a></li>
                    </ul>
                </li>
                @else
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>