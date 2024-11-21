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
                            <h6 class="mb-0">{{ __('Salutation Information') }}</h6>
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
                    <form method="post" action="{{ route('semester.update', $semester) }} " enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        @if ($errors->any())
                            <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                                <span class="alert-text text-white">
                                    {{ $errors->first() }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
                                role="alert">
                                <span class="alert-text text-white">
                                    {{ session('success') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="code" class="form-control-label">{{ __('Code') }}</label>
                                    <div class="@error('code')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ old('code', $semester->code) }}"
                                            type="text" placeholder="i.e : S3 24" id="code" name="code">
                                        @error('code')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">{{ __('Description') }}</label>
                                    <div class="@error('name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ old('name', $semester->name) }}"
                                            type="text" placeholder="i.e : SEMESTER 3 2024/2025" id="name"
                                            name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="year" class="form-control-label">{{ __('Academic Year') }}</label>
                                    <div class="@error('year')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ old('year', $semester->year) }}"
                                            type="text" placeholder="i.e : 2024" id="year" name="year">
                                        @error('year')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" name="edit" value="0"
                                class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                            &nbsp;&nbsp;<button type="submit" name="delete" value="1"
                                class="btn bg-gradient-danger btn-md mt-4 mb-4">{{ 'Delete' }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
