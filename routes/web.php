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
use App\Http\Controllers\WeeklyAllowanceController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\WordExportController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\CountingServiceController;
use App\Http\Controllers\LogController;

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

//Admin routes
Route::middleware('auth:sanctum', \App\Http\Middleware\RoleMiddleware::class . ':admin')->group(function () {

    // Authentication routes
    Route::get('/', [HomeController::class, 'dashboard']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
    Route::get('/disbursment/view_disbursment', [DisbursementController::class, 'viewDisbursement'])->name('disbursment.view_disbursment');
    Route::get('/export-pdf', [PDFController::class, 'exportPDF'])->name('export-pdf.index');
    Route::get('/preview-pdf/{pdf}', [PDFController::class, 'previewPDF'])->name('preview-pdf.index');
 
    // Cash counts resource routes
    Route::resource('cashcount', CashCountController::class);

    // Members resource routes
    Route::resource('member', MemberController::class);
    Route::get('members/search', [MemberController::class, 'search'])->name('member.search');

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

    // Givers resource routes
    Route::resource('donation', DonationController::class);

    // Finance resource routes
    Route::resource('accounting', FinanceController::class);
    Route::get('/monthly-report', [FinanceController::class, 'viewMonthList'])->name('accounting.report');
    Route::get('/monthly-report/{month}', [FinanceController::class, 'viewReportDetail'])->name('accounting.detail');

    // Givers resource routes
    Route::resource('giver', GiverController::class);
    Route::get('giver/search', [GiverController::class, 'search'])->name('giver.search');
    Route::get('giver/create/{date}', [GiverController::class, 'create'])->name('giver.create');


    // Allowance routes
    //Route::resource('/weekly_allowance', 'WeeklyAllowanceController');
    Route::get('/weekly_allowances', [WeeklyAllowanceController::class, 'index'])->name('allowances.index');
    Route::get('/weekly_allowance/create', [WeeklyAllowanceController::class, 'create'])->name('weekly_allowance.create');
    Route::post('/weekly_allowance', [WeeklyAllowanceController::class, 'store'])->name('weekly_allowance.store');
    Route::get('/weekly_allowance/{weekly_allowance}', [WeeklyAllowanceController::class, 'show'])->name('weekly_allowance.show');
    Route::get('/weekly_allowance/{weekly_allowance}/edit', [WeeklyAllowanceController::class, 'edit'])->name('weekly_allowance.edit');
    Route::delete('/weekly_allowance/{weekly_allowance}', [WeeklyAllowanceController::class, 'destroy'])->name('weekly_allowance.destroy');
    Route::put('/weekly_allowance/{weekly_allowance}', [WeeklyAllowanceController::class, 'update'])->name('weekly_allowance.update');
    Route::get('weekly_allowances/search', [WeeklyAllowanceController::class, 'search'])->name('weekly_allowance.search');

    // Route::resource('/allowance', Controllerweekly_allowance_follow_up::class);
    // Route::get('/weekly-allowance-follow-up', [Controllerweekly_allowance_follow_up::class, 'index'])->name('weekly-allowance-follow-up.index');

    // Voucher
    Route::get('/vouchers/{voucher}', [VoucherController::class, 'index'])->name('vouchers.index');

    // Counting
    Route::prefix('finance')->group(function () {
        Route::get('/counting_services/create', [CountingServiceController::class, 'create'])
            ->name('finance.counting_services.create');
        Route::post('/counting_services', [CountingServiceController::class, 'store'])
            ->name('finance.counting_services.store');
        Route::get('/counting_services/{countingService}/edit', [CountingServiceController::class, 'edit'])
            ->name('finance.counting_services.edit');
        Route::put('/counting_services/{countingService}', [CountingServiceController::class, 'update'])
            ->name('finance.counting_services.update');
        Route::delete('/counting_services/{countingService}', [CountingServiceController::class, 'destroy'])
            ->name('finance.counting_services.destroy');
        Route::get('/counting_services/{countingService}', [CountingServiceController::class, 'show'])
            ->name('finance.counting_services.show');
        Route::get('/counting_services/{date}', [CountingServiceController::class, 'goBack'])
            ->name('finance.counting_services.goBack');
        

    });
   
    Route::get('/counting_services', [CountingServiceController::class, 'index'])
        ->name('finance.counting_services.index');
    Route::get('/counting_services/print/{id}', [CountingServiceController::class, 'print'])
        ->name('finance.counting_services.print');

});

//Staff1 routes
Route::middleware('auth:sanctum', \App\Http\Middleware\RoleMiddleware::class . ':admin,staff1')->group(function () {

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
});

//Satff2 routes
Route::middleware('auth:sanctum', \App\Http\Middleware\RoleMiddleware::class . ':admin,staff2')->group(function () {

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