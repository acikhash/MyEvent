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
                            <h6 class="mb-0"> {{ __('Staff Information') }}</h6>
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
                    <form method="post" action="{{ route('staff.update', $staff) }} " enctype="multipart/form-data">
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
                                <label for="title_id" class="form-control-label">{{ __('Title') }}</label>
                                <select name="title_id" class="form-select" id="title_id">
                                    @foreach ($titles as $title)
                                        <option value={{ $title->id }} @if ($staff->title_id == $title->id) Selected @endif>
                                            {{ $title->name }}
                                        </option>
                                    @endforeach
                                </select>

                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">{{ __('Full Name') }}</label>
                                    <div class="@error('name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" value="{{ old('name', $staff->name) }}"
                                            placeholder="i.e : Ahmad Bin Ali" id="name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="department_id" class="form-control-label">{{ __('Department') }}</label>
                                <select name="department_id" class="form-select" id="department_id">
                                    @foreach ($departments as $dept)
                                        <option value={{ $dept->id }}
                                            @if ($staff->department_id == $dept->id) Selected @endif>
                                            {{ $dept->code }}-{{ $dept->name }}
                                        </option>
                                    @endforeach
                                </select>

                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="major_id" class="form-control-label">{{ __('Major') }}</label>
                                <select name="major_id" class="form-select" id="major_id">
                                    @foreach ($majors as $major)
                                        <option value={{ $major->id }}
                                            @if ($staff->major_id == $major->id) Selected @endif>{{ $major->name }}
                                        </option>
                                    @endforeach
                                </select>

                                </label>
                            </div>

                            <div class="col-md-6">
                                <label for="gred_id" class="form-control-label">{{ __('Grade') }}</label>
                                <select name="gred_id" class="form-select" id="gred_id">
                                    @foreach ($greds as $gred)
                                        <option value={{ $gred->id }}
                                            @if ($staff->gred_id == $gred->id) Selected @endif>{{ $gred->name }}</option>
                                        </option>
                                    @endforeach
                                </select>

                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="form-control-label">{{ __('Phone') }}</label>
                                    <div class="@error('phone')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ old('phone', $staff->phone) }}"
                                            type="tel" placeholder="i.e : 0134567899" id="phone" name="phone">
                                        @error('phone')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">{{ __('Email') }}</label>
                                    <div class="@error('email')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ old('email', $staff->email) }}"
                                            type="email" placeholder="i.e : test@.utm.my" id="email" name="email">
                                        @error('email')
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
