<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemebershipPlanController;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return view('welcome');
});

Route::view('/auth/login', 'auth.login')->name('login');

// ==================  Dashboard ==================
Route::view('/dashboard', 'dashboard')->name('dashboard');


// ==================  Member ==================
Route::view('/members/show',  'members.show')->name('members.show');
Route::view('/members/edit', 'members.edit')->name('members.edit');
Route::view('/members/attendance', 'members.attendance')->name('members.attendance');


Route::get('/members/create',[MemberController::class,'create'])->name('members.create');
Route::get('/members', [MemberController::class, 'index'])->name('members.index');
// Route::get('/members/{member}', [MemberController::class, 'show'])->name('members.show');


// ==================  Class ==================
Route::view('/classes', 'classes.index')->name('classes.index');
Route::view('/classes/create', 'classes.create')->name('classes.create');
Route::view('/classes/add', 'classes.add')->name('classes.add');
Route::view('/classes/edit', 'classes.edit')->name('classes.edit');
Route::view('/classes/show', 'classes.show')->name('classes.show');
Route::view('classes/update', 'classes.update')->name('classes.update');


// ================== Membership plan ==================
// Route::view('/plans', 'plans.create')->name('plans.create');
Route::get('/plans/create',[MemebershipPlanController::class,'create'])->name('plans.create');


// ================== Plan Subscription ==================
Route::view('subcriptions/update', 'subcriptions.update')->name('subcriptions.update');

