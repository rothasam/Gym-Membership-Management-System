<?php

use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::view('/', 'dashboard')->name('dashboard');
Route::view('/auth/login', 'auth.login')->name('login');
Route::view('/members/register', 'members.register')->name('members.register');
Route::view('/classes', 'classes.index')->name('classes.index');
Route::view('/classes/register', 'classes.register')->name('classes.register');
Route::view('/plans', 'plans.index')->name('plans.index');
Route::view('/partials/nav', 'partials.nav')->name('nav');
