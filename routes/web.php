<?php

use App\Http\Controllers\AttendeesController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuestCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Mail\MyTestEmail;
use App\Models\Event;
use Illuminate\Support\Facades\Mail;
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


    Route::get('/', [HomeController::class, 'home']);
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('billing', function () {
        return view('billing');
    })->name('billing');

    Route::get('profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('rtl', function () {
        return view('rtl');
    })->name('rtl');

    Route::get('user-management', function () {
        return view('laravel-examples/user-management');
    })->name('user-management');

    // Route::get('attendees', function () {
    //    return view('laravel-examples/attandees');
    // })->name('attendees');

    Route::get('tables', function () {
        return view('tables');
    })->name('tables');

    Route::get('virtual-reality', function () {
        return view('virtual-reality');
    })->name('virtual-reality');

    Route::get('static-sign-in', function () {
        return view('static-sign-in');
    })->name('sign-in');

    Route::get('static-sign-up', function () {
        return view('static-sign-up');
    })->name('sign-up');

    Route::get('/attendees', [Attendeescontroller::class, 'create']);
    Route::post('/attendees', [Attendeescontroller::class, 'store']);

    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
        return view('dashboard');
    })->name('sign-up');

    //event page
    Route::get('event', [EventController::class, 'index'])->name('event.index');
    Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/event/{event}', [EventController::class, 'update'])->name('event.update');
    Route::get('/event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::delete('/event/{event}', [EventController::class, 'destroy'])->name('event.destroy');
    Route::get('/event/{event}', [EventController::class, 'show'])->name('event.show');
    Route::post('/event', [EventController::class, 'store'])->name('event.store');
    //

    //guestcategory page
    Route::get('guestcategory', [GuestCategoryController::class, 'index'])->name('guestcategory.index');
    Route::get('/guestcategory/create', [GuestCategoryController::class, 'create'])->name('guestcategory.create');
    Route::post('/guestcategory/{guestcategory}', [GuestCategoryController::class, 'update'])->name('guestcategory.update');
    Route::get('/guestcategory/{id}/edit', [GuestCategoryController::class, 'edit'])->name('guestcategory.edit');
    Route::delete('/guestcategory/{guestcategory}', [GuestCategoryController::class, 'destroy'])->name('guestcategory.destroy');
    Route::get('/guestcategory/{guestcategory}', [GuestCategoryController::class, 'show'])->name('guestcategory.show');
    Route::post('/guestcategory', [GuestCategoryController::class, 'store'])->name('guestcategory.store');
    //
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
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
Route::get('/testroute', function () {
    // $inv = new Event();
    $name = "Guest";
    // $eventname = "Seminar AI";
    // $eventdate = "9-12-2024";
    // $starttime = "9.00 am";
    // $eventveneu = "Dewan 1";
    // $eventrsvp = route("event.index");

    // The email sending is done using the to method on the Mail facade
    Mail::to('noorhasni@graduate.utm.my')->send(new MyTestEmail($name));
});
