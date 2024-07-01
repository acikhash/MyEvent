@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="container-fluid">
            <div class="page-header min-height-100 border-radius-xl mt-4"
                style="background-image: url('/assets/img/curved-images/curved00.jpg'); background-position-y: 50%;">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6">
                <div class="row gx-4">
                    <div class="col-auto">
                    </div>
                    <div class="col-lg-6 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <h6 class="mb-0">{{ $event->name }} {{ __('Guest Information') }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header pb-0 px-3">

                </div>
                <div class="card-body pt-4 p-3">
                    <form method="POST" action="{{ route('guestl.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-text">
                                    {{ $errors->first() }}
                                </span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="m-3 alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-text">
                                    {{ session('success') }}
                                </span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="salutations"
                                        class="form-control-label">{{ __('Guest Salutations') }}</label>
                                    <input class="form-control" type="text" placeholder="i.e: Dato/Datin"
                                        id="salutations" name="salutations">
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
                                    <input class="form-control" type="hidden" name="event_id" id="event_id"
                                        value="{{ $event->id }}">
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
                                    <label for="contactNumber"
                                        class="form-control-label">{{ __('Contact Number') }}</label>
                                    <input class="form-control" type="tel" placeholder="0123456789" id="contactNumber"
                                        name="contactNumber">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">{{ __('Email') }}</label>
                                    <input class="form-control" type="email" placeholder="i.e: example@example.com"
                                        id="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="guest_category_id"
                                    class="form-control-label">{{ __('Guest Category') }}</label>
                                <select name="guest_category_id" class="form-select" id="guest_category_id">
                                    @foreach ($categories as $category)
                                        <option value={{ $category->id }}>{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" id="bringrep" name="bringrep">
                                    {{ __('Bring Representative') }}
                                </label>
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
    </div>
@endsection
