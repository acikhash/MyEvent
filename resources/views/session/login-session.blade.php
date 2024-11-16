@extends('layouts.user_type.guest')

@section('content')
    <nav
        class="navbar navbar-expand-lg position-absolute top-0 z-index-3 my-3 {{ Request::is('static-sign-up') ? 'w-100 shadow-none  navbar-transparent mt-4' : 'blur blur-rounded shadow py-2 start-0 end-0 mx4' }}">
        <div class="container-fluid {{ Request::is('static-sign-up') ? 'container' : 'container-fluid' }}">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 {{ Request::is('static-sign-up') ? 'text-white' : '' }}"
                href="{{ url('dashboard') }}">
                Teaching Load Assignment System (TLAS)
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav mx-auto">
                    @if (auth()->user())
                        {{-- <li class="nav-item">
                        <a class="nav-link d-flex align-items-center me-2 active" aria-current="page"
                            href="{{ url('dashboard') }}">
                            <i
                                class="fa fa-chart-pie opacity-6 me-1 {{ Request::is('static-sign-up') ? '' : 'text-dark' }}"></i>
                            Dashboard
                        </a>
                    </li> --}}
                        <li class="nav-item">
                            <a class="nav-link me-2" href="{{ url('profile') }}">
                                <i
                                    class="fa fa-user opacity-6 me-1 {{ Request::is('static-sign-up') ? '' : 'text-dark' }}"></i>
                                Profile
                            </a>
                        </li>
                    @endif
                    {{-- <li class="nav-item">
                        <a class="nav-link me-2" href="{{ auth()->user() ? url('static-sign-up') : url('register') }}">
                            <i
                                class="fas fa-user-circle opacity-6 me-1 {{ Request::is('static-sign-up') ? '' : 'text-dark' }}"></i>
                            Sign Up
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link me-2" href="{{ auth()->user() ? url('static-sign-in') : url('login') }}">
                            <i class="fas fa-key opacity-6 me-1 {{ Request::is('static-sign-up') ? '' : 'text-dark' }}"></i>
                            Sign In
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav d-lg-block d-none">
                    {{-- <li class="nav-item">
          <a href="https://www.creative-tim.com/product/soft-ui-dashboard-laravel" target="_blank" class="btn btn-sm btn-round mb-0 me-1 bg-gradient-{{ (Request::is('static-sign-up') ? 'light' : 'dark') }}">Free download</a>
        </li> --}}
                </ul>
            </div>
        </div>
    </nav>

    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                                    <p class="mb-0">Create a new acount<br></p>
                                    <p class="mb-0">OR Sign in with these credentials:</p>
                                    <p class="mb-0">Email <b>admin@softui.com</b></p>
                                    <p class="mb-0">Password <b>secret</b></p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="/session">
                                        @csrf
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Email" value="admin@softui.com" aria-label="Email"
                                                aria-describedby="email-addon">
                                            @error('email')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Password" value="secret" aria-label="Password"
                                                aria-describedby="password-addon">
                                            @error('password')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign
                                                in</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <small class="text-muted">Forgot you password? Reset you password
                                        <a href="/login/forgot-password"
                                            class="text-info text-gradient font-weight-bold">here</a>
                                    </small>
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <a href="register" class="text-info text-gradient font-weight-bold">Sign up</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
