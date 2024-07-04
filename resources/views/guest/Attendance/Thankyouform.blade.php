@extends('layouts.user_type.guest')

@section('content')
<div class="page-header align-items-start min-vh-20 pt-5 pb-11 mx-3 border-radius-lg"
            style="background-image: url('/assets/img/curved-images/curved14.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">

                    </div>
                </div>
            </div>
        </div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                @if (session('success'))
                    <div class="m-3 alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-text">
                            {{ session('success') }}
                        </span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h6 class="mb-0 text-center">{{ __('Thank You') }}</h6>
                <p class="mb-0 text-center">{{ __('Your information has been submitted successfully.') }}</p>
            </div>
        </div>
    </div>
@endsection
