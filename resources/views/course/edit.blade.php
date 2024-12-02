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
                            <h6 class="mb-0">{{ __('Course Information') }}</h6>
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
                    <form method="post" action="{{ route('course.update', $course) }} " enctype="multipart/form-data">
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
                            <div class="col-md-6">
                                <label for="program_id" class="form-control-label">{{ __('Program') }}</label>
                                <select name="program_id" class="form-select" id="program_id">
                                    @foreach ($programs as $program)
                                        <option value={{ $program->id }} @if ($course->program_id == $program->id) Selected @endif>
                                            {{ $program->code }}-{{ $program->name }}
                                        </option>
                                    @endforeach
                                </select>

                                </label>
                            </div>
                            <div class="col-md-6">
                                <label for="semester_id" class="form-control-label">{{ __('Semester') }}</label>
                                <select name="semester_id" class="form-select" id="semester_id">
                                    @foreach ($semesters as $semester)
                                        <option value={{ $semester->id }} @if ($course->semester_id == $program->id) Selected @endif>
                                            {{ $semester->name }}
                                        </option>
                                    @endforeach
                                </select>

                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code" class="form-control-label">{{ __('Course Code') }}</label>
                                    <div class="@error('code')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ old('code', $course->code) }}" type="text"
                                            placeholder="i.e : UANP6013" id="code" name="code">
                                        @error('code')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">{{ __('Course Name') }}</label>
                                    <div class="@error('name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ old('name', $course->name) }}" type="text"
                                            placeholder="i.e : Research Methodology" id="name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="section" class="form-control-label">{{ __('Section') }}</label>
                                    <div class="@error('section')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ old('section', $course->section) }}"
                                            type="text" placeholder="i.e : 03" id="section" name="section">
                                        @error('section')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="credit" class="form-control-label">{{ __('Credit') }}</label>
                                    <div class="@error('credit')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ old('credit', $course->credit) }}"
                                            type="number" placeholder="i.e : 3" id="credit" name="credit">
                                        @error('credit')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="no_of_student"
                                        class="form-control-label">{{ __('No of Students') }}</label>
                                    <div class="@error('no_of_student')border border-danger rounded-3 @enderror">
                                        <input class="form-control"
                                            value="{{ old('no_of_student', $course->no_of_student) }}" type="number"
                                            placeholder="i.e : 10" id="no_of_student" name="no_of_student">
                                        @error('no_of_student')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" name="edit" value="0"
                                class="btn bg-gradient-primary btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>

                            &nbsp;&nbsp;<button type="submit" name="delete" value="1"
                                class="btn bg-gradient-danger btn-md mt-4 mb-4">{{ 'Delete' }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
