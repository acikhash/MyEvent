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
                            <h6 class="mb-0">{{ __('Assign Lecturer') }}</h6>
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
                    <form method="post" action="{{ route('assignment.store') }} " enctype="multipart/form-data">
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
                                <div class="form-group">
                                    <label for="program" class="form-control-label">{{ __('Program') }}</label>
                                    <input type="hidden" name="program_id" class="form-control" id="program_id"
                                        value="{{ $course->program->id }}">
                                    <div class="@error('program')border border-danger rounded-3 @enderror">
                                        <input class="form-control"
                                            value="{{ $course->program->code }}-{{ $course->program->name }} "
                                            id="program" name="program" readonly>
                                        @error('program')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="semester" class="form-control-label">{{ __('Semester') }}</label>
                                    <div class="@error('semester')border border-danger rounded-3 @enderror">
                                        <input type="hidden" name="semester_id" id="semester_id"
                                            value="{{ $course->semester->id }}">
                                        <input type="hidden" name="year" id="year"
                                            value="{{ $course->semester->year }}">
                                        <input class="form-control"
                                            value="{{ $course->semester->year }}-{{ $course->semester->name }}"
                                            type="text" id="semester" name="semester" readonly>
                                        @error('semester')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code" class="form-control-label">{{ __('Course Code') }}</label>
                                    <input type="hidden" name="course_id" class="form-control" id="course_id"
                                        value="{{ $course->id }}">
                                    <div class="@error('code')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ old('code', $course->code) }}" type="text"
                                            placeholder="i.e : UANP6013" id="code" name="code" readonly>
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
                                            placeholder="i.e : Research Methodology" id="name" name="name" readonly>
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
                                            type="text" placeholder="i.e : 03" id="section" name="section"
                                            readonly>
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
                                            type="number" placeholder="i.e : 3" id="credit" name="credit" readonly>
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
                                            placeholder="i.e : 10" id="no_of_student" name="no_of_student" readonly>
                                        @error('no_of_student')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="mb-0">{{ __('Lecturer Assigned') }}</h6>
                                <table style="width: 100%;" name="assign" id="assign">
                                    <thead>
                                        <tr>
                                            <th style="border: 1px solid">Staff ID</th>
                                            <th style="border: 1px solid">Name</th>
                                            <th style="border: 1px solid">Major</th>
                                            <th style="border: 1px solid">Grade</th>
                                            <th style="border: 1px solid">Department</th>
                                            <th style="border: 1px solid">Notes</th>
                                            <th style="border: 1px solid">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($staffs as $index => $staff)
                                            <tr>
                                                <td>
                                                    {{ $staff->id }}
                                                    <input type="hidden" name="rows[{{ $index }}][staff_id]"
                                                        value="{{ $staff->id }}">
                                                </td>
                                                <td>
                                                    {{ $staff->title }} {{ $staff->name }}
                                                    <input type="hidden" name="rows[{{ $index }}][staff_name]"
                                                        value="{{ $staff->title }} {{ $staff->name }}">
                                                </td>
                                                <td>
                                                    {{ $staff->major }}

                                                </td>
                                                <td>
                                                    {{ $staff->gred }}

                                                <td>
                                                    {{ $staff->department }}
                                                </td>
                                                <td>
                                                    <input type="text" name="rows[{{ $index }}][notes]"
                                                        id="rows[{{ $index }}][notes]" class="form-control"
                                                        value=" {{ $assignments[$index]->notes }}" readonly>
                                                    <input type="hidden" name="rows[{{ $index }}][action]"
                                                        id="rows[{{ $index }}][action]">
                                                </td>
                                                <td>
                                                    <button type="button" onclick="updateRow(this)"
                                                        class="fas fa-edit text-secondary btn-md mt-4 mb-4"></button>

                                                    <button type="button" onclick="removeRow(this)"
                                                        class="fas fa-trash text-secondary btn-md mt-4 mb-4"></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                </label>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="mb-0">{{ __('Assign New Lecturer') }}</h6>
                                <button type="button" name="search" value="0"
                                    class="btn bg-gradient-primary btn-md mt-4 mb-4"
                                    onclick="toggleSearchLecturer()">{{ 'Search Lecturer' }}</button>


                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" name="edit" value="0"
                                class="btn bg-gradient-primary btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                        </div>
                    </form>
                    <div class="row" id="searchlec" hidden>
                        <div class="col-md-12">
                            <livewire:assign-lec />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('js/assignLecturers.js') }}"></script>
