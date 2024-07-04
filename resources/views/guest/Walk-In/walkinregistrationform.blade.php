@extends('layouts.user_type.guest')

@section('content')
    <script src="/assets/js/plugins/flatpickr.min.js"></script>
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg"
        style="background-image: url('/assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                    <p class="text-lead text-white">Please fill Up the registration form.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Walk-in Guest Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form method="POST" action="{{ route('guest.walkinstore') }}" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                        <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="alert-text">
                                {{ $errors->first() }}
                            </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="m-3 alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-text">
                                {{ session('success') }}
                            </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="salutations" class="form-control-label">{{ __('Guest Salutations') }}</label>
                                <input class="form-control" type="text" placeholder="i.e: Dato/Datin" id="salutations"
                                    name="salutations">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">{{ __('Guest Name') }}</label>
                                <input class="form-control" type="text" placeholder="i.e: Will Smith" id="name"
                                    name="name">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="organization" class="form-control-label">{{ __('Organization') }}</label>
                                <input class="form-control" type="text" placeholder="i.e: Synergy Software House"
                                    id="organization" name="organization">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address" class="form-control-label">{{ __('Address') }}</label>
                                <input class="form-control" type="text" placeholder="i.e: 123 Main St" id="address"
                                    name="address">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contactNumber" class="form-control-label">{{ __('Contact Number') }}</label>
                                <input class="form-control" type="tel" placeholder="0123456789" id="contactNumber"
                                    name="contactNumber">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-control-label">{{ __('Email') }}</label>
                                <input class="form-control" type="email" placeholder="i.e: example@example.com"
                                    id="email" name="email">
                                <input class="form-control" type="hidden" value={{ $event_id }} id="event_id"
                                    name="event_id">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <button type="submit"
                                class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ __('Submit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
