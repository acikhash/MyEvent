<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\StaffController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/static-sign-up', [RegisterController::class, 'store'])->name('signup');
    Route::get('/', [HomeController::class, 'home']);
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


    Route::get('profile', function () {
        return view('profile');
    })->name('profile');



    Route::get('user-management', function () {
        return view('laravel-examples/user-management');
    })->name('user-management');


    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
        return view('dashboard');
    })->name('sign-up');



    //staff page
    Route::get('staff', [StaffController::class, 'index'])->name('staff.index');
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/staff/{staff}', [StaffController::class, 'update'])->name('staff.update');
    Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
    Route::delete('/staff/{staff}', [StaffController::class, 'destroy'])->name('staff.destroy');
    Route::get('/staff/{id}', [StaffController::class, 'show'])->name('staff.show');
    Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
    //

    // Department routes
    Route::get('departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/{id}', [DepartmentController::class, 'show'])->name('departments.show');
    Route::get('/departments/{id}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::post('/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
    //

    // Faculty routes
    Route::get('faculties', [FacultyController::class, 'index'])->name('faculties.index');
    Route::get('/faculties/create', [FacultyController::class, 'create'])->name('faculties.create');
    Route::post('/faculties', [FacultyController::class, 'store'])->name('faculties.store');
    Route::get('/faculties/{id}', [FacultyController::class, 'show'])->name('faculties.show');
    Route::get('/faculties/{id}/edit', [FacultyController::class, 'edit'])->name('faculties.edit');
    Route::post('/faculties/{faculty}', [FacultyController::class, 'update'])->name('faculties.update');
    Route::delete('/faculties/{faculty}', [FacultyController::class, 'destroy'])->name('faculties.destroy');
    //

    // Major routes
    Route::get('majors', [MajorController::class, 'index'])->name('majors.index');
    Route::get('/majors/create', [MajorController::class, 'create'])->name('majors.create');
    Route::post('/majors', [MajorController::class, 'store'])->name('majors.store');
    Route::get('/majors/{id}', [MajorController::class, 'show'])->name('majors.show');
    Route::get('/majors/{id}/edit', [MajorController::class, 'edit'])->name('majors.edit');
    Route::post('/majors/{major}', [MajorController::class, 'update'])->name('majors.update');
    Route::delete('/majors/{major}', [MajorController::class, 'destroy'])->name('majors.destroy');
    //

    // Program routes
    Route::get('programs', [ProgramController::class, 'index'])->name('programs.index');
    Route::get('/programs/create', [ProgramController::class, 'create'])->name('programs.create');
    Route::post('/programs', [ProgramController::class, 'store'])->name('programs.store');
    Route::get('/programs/{id}', [ProgramController::class, 'show'])->name('programs.show');
    Route::get('/programs/{id}/edit', [ProgramController::class, 'edit'])->name('programs.edit');
    Route::post('/programs/{program}', [ProgramController::class, 'update'])->name('programs.update');
    Route::delete('/programs/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy');

    // Course routes
    Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::post('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    //

    // Assignment routes
    Route::get('assignments', [AssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/create', [AssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
    Route::get('/assignments/{id}', [AssignmentController::class, 'show'])->name('assignments.show');
    Route::get('/assignments/{id}/edit', [AssignmentController::class, 'edit'])->name('assignments.edit');
    Route::post('/assignments/{assignment}', [AssignmentController::class, 'update'])->name('assignments.update');
    Route::delete('/assignments/{assignment}', [AssignmentController::class, 'destroy'])->name('assignments.destroy');
});

//send invitation email
Route::get('/invitation/{id}', [NotificationController::class, 'sendInvitation'])->name('email.send');
// Sent QR code email
Route::get('/sentQR/{id}', [NotificationController::class, 'sendQR'])->name('email.sentqr');



Route::group(['middleware' => 'guest'], function () {

    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
