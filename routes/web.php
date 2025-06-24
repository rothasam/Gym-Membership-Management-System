<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemebershipPlanController;
use App\Http\Controllers\ClassController;
use Illuminate\Support\Facades\Route;


// ==================  Login ==================
// Show login form
// Route::view('/', 'auth.login')->name('login');
// Route::get('/',[UserController::class,'index'])->name('login');

// Route::get('/', [UserController::class, 'showLoginForm'])->name('login');


// // Handle login POST
// Route::post('/', [UserController::class, 'login'])->name('login');


Route::middleware('guest')->group(function () {
    Route::get('/', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/', [UserController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');


    // ==================  Member ==================
    Route::view('/members/show',  'members.show')->name('members.show');
    Route::view('/members/edit', 'members.edit')->name('members.edit');
    Route::view('/members/attendance', 'members.attendance')->name('members.attendance');
    Route::get('/members/create',[MemberController::class,'create'])->name('members.create');
    Route::get('/members', [MemberController::class, 'index'])->name('members.index');

    // ==================  Class ==================
    Route::prefix('classes')->group(function () {
        Route::get('/', [ClassController::class, 'index'])->name('classes.index');
        Route::get('/add', [ClassController::class, 'add'])->name('classes.add');
        Route::post('/store', [ClassController::class, 'store'])->name('classes.store');
        Route::get('/create', [ClassController::class, 'create'])->name('classes.create');
        Route::get('/{classes}', [ClassController::class, 'show'])->name('classes.show');
        Route::get('/edit/{classes}', [ClassController::class, 'edit'])->name('classes.edit');
        Route::put('/{classes}', [ClassController::class, 'update'])->name('classes.update');
        Route::delete('/delete/{classes}', [ClassController::class, 'destroy'])->name('classes.destroy');
    });

    // ================== Membership plan ==================
    Route::get('/plans/create',[MemebershipPlanController::class,'create'])->name('plans.create');

    // ================== Plan Subscription ==================
    Route::view('subcriptions/update', 'subcriptions.update')->name('subcriptions.update');
    

    Route::put('/admin/profile', [UserController::class, 'updateProfile'])->name('admin.update.profile');
});


// ==================  Logout ==================
Route::post('/logout',[UserController::class,'logout'])->name('logout');


// ==================  Member ==================
Route::view('/members/show',  'members.show')->name('members.show');
Route::view('/members/edit', 'members.edit')->name('members.edit');
Route::view('/members/attendance', 'members.attendance')->name('members.attendance');
Route::get('/members/create',[MemberController::class,'create'])->name('members.create');
Route::get('/members', [MemberController::class, 'index'])->name('members.index');
// Route::get('/members/{member}', [MemberController::class, 'show'])->name('members.show');


 

// ================== Membership plan ==================
// Route::view('/plans', 'plans.create')->name('plans.create');
Route::get('/plans/create',[MemebershipPlanController::class,'create'])->name('plans.create');


Route::put('/admin/profile', [UserController::class, 'updateProfile'])->name('admin.update.profile');


