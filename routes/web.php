<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\GredController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TitleController;
use App\Models\User;

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


Route::group(
    ['middleware' => 'auth'],
    function () {

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

        // Program routes
        Route::get('program', [ProgramController::class, 'index'])->name('program.index');
        Route::get('/program/create', [ProgramController::class, 'create'])->name('program.create');
        Route::post('/program', [ProgramController::class, 'store'])->name('program.store');
        Route::get('/program/{id}', [ProgramController::class, 'show'])->name('program.show');
        Route::get('/program/{id}/edit', [ProgramController::class, 'edit'])->name('program.edit');
        Route::post('/program/{program}', [ProgramController::class, 'update'])->name('program.update');
        Route::delete('/program/{program}', [ProgramController::class, 'destroy'])->name('program.destroy');

        // Course routes
        Route::get('course', [CourseController::class, 'index'])->name('course.index');
        Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
        Route::post('/course', [CourseController::class, 'store'])->name('course.store');
        Route::get('/course/{id}', [CourseController::class, 'show'])->name('course.show');
        Route::get('/course/{id}/edit', [CourseController::class, 'edit'])->name('course.edit');
        Route::post('/course/{course}', [CourseController::class, 'update'])->name('course.update');
        Route::delete('/course/{course}', [CourseController::class, 'destroy'])->name('course.destroy');
        //

        // Assignment routes
        Route::get('assignment', [AssignmentController::class, 'index'])->name('assignment.index');
        Route::get('/assignment/create', [AssignmentController::class, 'create'])->name('assignment.create');
        Route::post('/assignment', [AssignmentController::class, 'store'])->name('assignment.store');
        Route::get('/assignment/{id}', [AssignmentController::class, 'show'])->name('assignment.show');
        Route::get('/assignment/{id}/edit', [AssignmentController::class, 'edit'])->name('assignment.edit');
        Route::post('/assignment/{assignment}', [AssignmentController::class, 'update'])->name('assignment.update');
        Route::delete('/assignment/{assignment}', [AssignmentController::class, 'destroy'])->name('assignment.destroy');

        // Semester routes
        Route::get('semester', [SemesterController::class, 'index'])->name('semester.index');
        Route::get('/semester/create', [SemesterController::class, 'create'])->name('semester.create');
        Route::post('/semester', [SemesterController::class, 'store'])->name('semester.store');
        Route::get('/semester/{id}', [SemesterController::class, 'show'])->name('semester.show');
        Route::get('/semester/{id}/edit', [SemesterController::class, 'edit'])->name('semester.edit');
        Route::post('/semester/{semester}', [SemesterController::class, 'update'])->name('semester.update');
        Route::delete('/semester/{semester}', [SemesterController::class, 'destroy'])->name('semester.destroy');

        // Grade routes
        Route::get('grade', [GredController::class, 'index'])->name('grade.index');
        Route::get('/grade/create', [GredController::class, 'create'])->name('grade.create');
        Route::post('/grade', [GredController::class, 'store'])->name('grade.store');
        Route::get('/grade/{id}', [GredController::class, 'show'])->name('grade.show');
        Route::get('/grade/{id}/edit', [GredController::class, 'edit'])->name('grade.edit');
        Route::post('/grade/{grade}', [GredController::class, 'update'])->name('grade.update');
        Route::delete('/grade/{grade}', [GredController::class, 'destroy'])->name('grade.destroy');

        // title routes
        Route::get('title', [TitleController::class, 'index'])->name('title.index');
        Route::get('/title/create', [TitleController::class, 'create'])->name('title.create');
        Route::post('/title', [TitleController::class, 'store'])->name('title.store');
        Route::get('/title/{id}', [TitleController::class, 'show'])->name('title.show');
        Route::get('/title/{id}/edit', [TitleController::class, 'edit'])->name('title.edit');
        Route::post('/title/{title}', [TitleController::class, 'update'])->name('title.update');
        Route::delete('/title/{title}', [TitleController::class, 'destroy'])->name('title.destroy');


        //View Workload
        Route::get('/workload', [AssignmentController::class, 'show'])->name('workload.index');
        Route::get('/workload/print', [AssignmentController::class, 'workload'])->name('workload.print');
        //

        //staff page
        Route::get('staff', [StaffController::class, 'index'])->name('staff.index');
        Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
        Route::post('/staff/{staff}', [StaffController::class, 'update'])->name('staff.update');
        Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
        Route::delete('/staff/{staff}', [StaffController::class, 'destroy'])->name('staff.destroy');
        Route::get('/staff/{id}', [StaffController::class, 'show'])->name('staff.show');
        Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
        //

        // Faculty routes
        Route::get('faculty', [FacultyController::class, 'index'])->name('faculty.index');
        Route::get('/faculty/create', [FacultyController::class, 'create'])->name('faculty.create');
        Route::post('/faculty', [FacultyController::class, 'store'])->name('faculty.store');
        Route::get('/faculty/{id}', [FacultyController::class, 'show'])->name('faculty.show');
        Route::get('/faculty/{id}/edit', [FacultyController::class, 'edit'])->name('faculty.edit');
        Route::post('/faculty/{faculty}', [FacultyController::class, 'update'])->name('faculty.update');
        Route::delete('/faculty/{faculty}', [FacultyController::class, 'destroy'])->name('faculty.destroy');
        //

        // Department routes
        Route::get('departments', [DepartmentController::class, 'index'])->name('department.index');
        Route::get('/departments/create', [DepartmentController::class, 'create'])->name('department.create');
        Route::post('/departments', [DepartmentController::class, 'store'])->name('department.store');
        Route::get('/departments/{id}', [DepartmentController::class, 'show'])->name('department.show');
        Route::get('/departments/{id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
        Route::post('/departments/{department}', [DepartmentController::class, 'update'])->name('department.update');
        Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->name('department.destroy');
        //

        // Major routes
        Route::get('major', [MajorController::class, 'index'])->name('major.index');
        Route::get('/major/create', [MajorController::class, 'create'])->name('major.create');
        Route::post('/major', [MajorController::class, 'store'])->name('major.store');
        Route::get('/major/{id}', [MajorController::class, 'show'])->name('major.show');
        Route::get('/major/{id}/edit', [MajorController::class, 'edit'])->name('major.edit');
        Route::post('/major/{major}', [MajorController::class, 'update'])->name('major.update');
        Route::delete('/major/{major}', [MajorController::class, 'destroy'])->name('major.destroy');
        //
        //event page
        Route::get('event', [EventController::class, 'index'])->name('event.index');
        Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
        Route::post('/event/{event}', [EventController::class, 'update'])->name('event.update');
        Route::get('/event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
        Route::delete('/event/{event}', [EventController::class, 'destroy'])->name('event.destroy');
        Route::get('/event/{id}', [EventController::class, 'show'])->name('event.show');
        Route::get('/qr/{event_id}', [EventController::class, 'qr'])->name('event.qr');
        Route::post('/event', [EventController::class, 'store'])->name('event.store');
        Route::get('/generate-pdf/{id}', [EventController::class, 'generatePdf'])->name('event.generatePdf');
        //
    }
);

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
