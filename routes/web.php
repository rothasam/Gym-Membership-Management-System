<?php
use Illuminate\Support\Facades\Route;


Route::view('/auth/login', 'auth.login')->name('login');

// ==================  Dashboard ==================
Route::view('/dashboard', 'dashboard')->name('dashboard');


// ==================  Member ==================
Route::view('/members/register', 'members.register')->name('members.register');
Route::view('/members/show', 'members.show')->name('members.show');
Route::view('/members/detail', 'members.detail')->name('members.detail');
Route::view('/members/edit', 'members.edit')->name('members.edit');
Route::view('/members/attendance', 'members.attendance')->name('members.attendance');

// ==================  Class ==================
Route::view('/classes', 'classes.index')->name('classes.index');
Route::view('/classes/create', 'classes.create')->name('classes.create');
Route::view('/classes/add', 'classes.add')->name('classes.add');
Route::view('/classes/edit', 'classes.edit')->name('classes.edit');
Route::view('/classes/show', 'classes.show')->name('classes.show');
Route::view('classes/update', 'classes.update')->name('classes.update');


// ================== Membership plan ==================
Route::view('/plans', 'plans.create')->name('plans.create');
// Route::view('/partials/nav', 'partials.nav')->name('nav');

// ================== Plan Subscription ==================
Route::view('subcriptions/update', 'subcriptions.update')->name('subcriptions.update');

