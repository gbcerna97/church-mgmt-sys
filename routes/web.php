<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\Finance\GiverController;
use App\Http\Controllers\Finance\CashCountController;
use App\Http\Controllers\Finance\FinanceController;
use App\Http\Controllers\Finance\DisbursementController;
use App\Http\Controllers\Finance\DisbursementRequestController;
use App\Http\Controllers\Finance\DonationController;
use App\Http\Controllers\Event\AttendanceController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\Membership\MemberController;
use App\Http\Controllers\Inventory\InventoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth:sanctum')->group(function () {

    // Authentication routes
    Route::get('/', [HomeController::class, 'dashboard']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');
    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store'])->name('user.update');
    Route::get('/login', function () {
		return view('dashboard');
	})->name('user.login');

    // Disbursement requests resource routes
    Route::resource('request', DisbursementRequestController::class);

    // Disbursement resource routes
    Route::resource('disbursement', DisbursementController::class);
 
    // Cash counts resource routes
    Route::resource('cashcount', CashCountController::class);

    // For staff 1
    // Members resource routes
    Route::resource('member', MemberController::class);

    // Events resource routes
    Route::resource('events', EventController::class);

    // Attendance routes
    Route::get('/attendance', [AttendanceController::class, 'index'])
        ->name('attendance.index');
    Route::post('/attendance', [AttendanceController::class, 'store'])
        ->name('attendance.store');
    Route::get('/attendance/view', [AttendanceController::class, 'viewAttendance'])
        ->name('attendance.view');

    // Inventory resource routes
    Route::resource('inventory', InventoryController::class);
    Route::get('/all-inventory', [InventoryController::class, 'viewAll'])->name('inventory.all');

    //For staff 2
    // Givers resource routes
    Route::resource('donation', DonationController::class);

    // Finance resource routes
    Route::resource('accounting', FinanceController::class);

    // Givers resource routes
    Route::resource('giver', GiverController::class);
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store'])->name('user.register');
    Route::get('/login', [SessionsController::class, 'create'])->name('user.login');
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');