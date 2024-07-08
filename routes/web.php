<?php

// use App\Http\Controllers\GuestListManagementController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuestCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Mail\MyTestEmail;
use App\Models\Event;
use App\Models\Guest;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\GuestController;
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
    //Route::post('r_frame/{schedule}', [DashboardController::class, 'r_frame'])->name('r_frame');
    // Route::get('billing', function () {
    //     return view('billing');
    // })->name('billing');

    Route::get('profile', function () {
        return view('profile');
    })->name('profile');

    // Route::get('rtl', function () {
    //     return view('rtl');
    // })->name('rtl');

    Route::get('user-management', function () {
        return view('laravel-examples/user-management');
    })->name('user-management');


    //Guest Management

    Route::get('/guest/{id}/Representativeform', [GuestController::class, 'RepresentativeCreate'])->name('guest.representativeform');
    Route::post('/guest/{id}/Representativeform', [GuestController::class, 'RepresentativeStore'])->name('guest.RepresentativeStore');
    Route::get('/guest/{id}/Updateattendanceform', [GuestController::class, 'Updateattendanceshow'])->name('guest.representativeform');
    Route::post('/guest/{id}/Updateattendanceform', [GuestController::class, 'Updateattendancestore'])->name('guest.Updateattendancestore');
    Route::get('/Walk-inRegistrationform/{event_id}', [GuestController::class, 'walkincreate'])->name('guest.walkinregistrationform');
    Route::post('/Walk-inRegistrationform', [GuestController::class, 'walkinstore'])->name('guest.walkinstore');
    Route::get('/Thankyouform', [GuestController::class, 'ThankYou'])->name('guest.Thankyouform');


    //get guest filter by event
    Route::get('/guestlist/{event}', [GuestController::class, 'index'])->name('guestl.index');
    Route::get('/guestlist/create/{event}', [GuestController::class, 'create'])->name('guestl.create');
    Route::post('/guestlist/{guest}', [GuestController::class, 'update'])->name('guestl.update');
    Route::get('/guestlist/{id}/edit', [GuestController::class, 'edit'])->name('guestl.edit');
    Route::delete('/guestlist/{guest}', [GuestController::class, 'destroy'])->name('guestl.destroy');
    Route::get('/guestlist/{guest}', [GuestController::class, 'show'])->name('guestl.show');
    Route::post('/guestlist', [GuestController::class, 'store'])->name('guestl.store');

    /** guestlist */
    Route::get('/GuestList', [GuestController::class, 'GuestList']);
    /** */

    //Qr Code
    Route::get('/QRcode/{id}', [QRCodeController::class, 'QRcode'])->name('guest.qrcode');
    Route::get('/checkin/{id}', [QRCodeController::class, 'checkin'])->name('guest.checkin');
    Route::post('/checkin/{id}', [QRCodeController::class, 'checkinupdate'])->name('guest.checkinupdate');
    Route::get('/guest/attendance/scan', [QRCodeController::class, 'scan'])->name('guest.Attendance.scan');
    Route::post('/guest/attendance/scan', [QRCodeController::class, 'processScan'])->name('guest.Attendance.scan');

    //Route::post('/process-scan', [QRCodeController::class, 'processScan']);



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
    Route::get('/event/{id}', [EventController::class, 'show'])->name('event.show');
    Route::get('/qr/{event_id}', [EventController::class, 'qr'])->name('event.qr');
    Route::post('/event', [EventController::class, 'store'])->name('event.store');
    Route::get('/generate-pdf/{id}', [EventController::class, 'generatePdf'])->name('event.generatePdf');;
    //

    //guestcategory page
    Route::get('guestcategory/{event}', [GuestCategoryController::class, 'index'])->name('guestcategory.index');
    Route::get('/guestcategory/create/{event}', [GuestCategoryController::class, 'create'])->name('guestcategory.create');
    Route::post('/guestcategory/{guestcategory}', [GuestCategoryController::class, 'update'])->name('guestcategory.update');
    Route::get('/guestcategory/{id}/edit', [GuestCategoryController::class, 'edit'])->name('guestcategory.edit');
    Route::delete('/guestcategory/{guestcategory}', [GuestCategoryController::class, 'destroy'])->name('guestcategory.destroy');
    Route::get('/guestcategory/{guestcategory}', [GuestCategoryController::class, 'show'])->name('guestcategory.show');
    Route::post('/guestcategory', [GuestCategoryController::class, 'store'])->name('guestcategory.store');

    //
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

    Route::get('/Walk-inRegistrationform/{event_id}', [GuestController::class, 'walkincreate'])->name('guest.walkinregistrationform');
    Route::post('/Walk-inRegistrationform', [GuestController::class, 'walkinstore'])->name('guest.walkinstore');

    Route::get('/guest/{id}/Representativeform', [GuestController::class, 'RepresentativeCreate'])->name('guest.representativeform');
    Route::post('/guest/{id}/Representativeform', [GuestController::class, 'RepresentativeStore'])->name('guest.RepresentativeStore');

    Route::get('/guest/{id}/Updateattendanceform', [GuestController::class, 'Updateattendanceshow'])->name('guest.representativeform');
    Route::post('/guest/{id}/Updateattendanceform', [GuestController::class, 'Updateattendancestore'])->name('guest.Updateattendancestore');

    Route::get('/Thankyouform', [GuestController::class, 'ThankYou'])->name('guest.Thankyouform');
});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
