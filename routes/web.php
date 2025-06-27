<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemebershipPlanController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassRegisterController;
use App\Http\Controllers\DailyAttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlanSubscriptionController;
use App\Models\DailyAttendance;
use Illuminate\Support\Facades\Route;


// ==================  Login ==================
Route::middleware('guest')->group(function () {
    Route::get('/', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/', [UserController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
     // ================== Dashboard ==================
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.index');
    
    // ================== Member  ==================
    Route::prefix('/members')->name('members.')->group(function () {

        Route::view('attendance', 'members.attendance')->name('attendance');

        Route::get('/', [MemberController::class, 'index'])->name('index');
        Route::get('/create', [MemberController::class, 'create'])->name('create');
        Route::post('/', [MemberController::class, 'store'])->name('store');
        Route::get('{member}', [MemberController::class, 'show'])->name('show');
        Route::get('edit/{member}', [MemberController::class, 'edit'])->name('edit');
        Route::put('{member}', [MemberController::class, 'update'])->name('update');

    });

    Route::delete('/members/delete/{member}',[MemberController::class,'destroy'])->name('members.destroy');
    Route::post('/subscriptions/upgrade', [PlanSubscriptionController::class, 'upgradePlan'])->name('subscriptions.upgrade');

    
    // ==================  Class ==================
    Route::prefix('classes')->group(function () {
        Route::get('/create', [ClassController::class, 'create'])->name('classes.create');
        Route::get('/', [ClassController::class, 'index'])->name('classes.index');
        Route::get('/add', [ClassController::class, 'add'])->name('classes.add');
        Route::post('/store', [ClassController::class, 'store'])->name('classes.store');
        Route::get('/{classes}', [ClassController::class, 'show'])->name('classes.show');
        Route::get('/edit/{classes}', [ClassController::class, 'edit'])->name('classes.edit');
        Route::put('/{classes}', [ClassController::class, 'update'])->name('classes.update');
        Route::delete('/delete/{classes}', [ClassController::class, 'destroy'])->name('classes.destroy');
    });    

    // ================== Attendance  ==================
    Route::get('/daily_attendance', [DailyAttendanceController::class, 'index'])->name('daily_attendance.index');
    Route::post('/daily_attendance/{id}/check_in',[DailyAttendanceController::class,'store'])->name('daily_attendance.store');


    // ================== Membership plan ==================
    Route::get('/plans', [MemebershipPlanController::class, 'index'])->name('plans.index');
    Route::get('/plans/create', [MemebershipPlanController::class, 'create'])->name('plans.create');
    Route::post('/plans', [MemebershipPlanController::class, 'store'])->name('plans.store');
    Route::get('/plans/{plan}', [MemebershipPlanController::class, 'show'])->name('plans.show');
    Route::get('/plans/{plan}/edit', [MemebershipPlanController::class, 'edit'])->name('plans.edit');
    Route::put('/plans/{plan}', [MemebershipPlanController::class, 'update'])->name('plans.update');
    Route::delete('/plans/{plan}', [MemebershipPlanController::class, 'destroy'])->name('plans.destroy');

    // ================== Plan Subscription ==================
    Route::view('subcriptions/update', 'subcriptions.update')->name('subcriptions.update');
    

    Route::put('/admin/profile', [UserController::class, 'updateProfile'])->name('admin.update.profile');


     // ================== Class Registeration ==================
     Route::get('/class_register/register',[ClassRegisterController::class,'index'])->name('class_register.register');
     Route::post('/class_register/register',[ClassRegisterController::class,'store'])->name('class_register.store');
     
});


// ==================  Logout ==================
Route::post('/logout',[UserController::class,'logout'])->name('logout');

 






