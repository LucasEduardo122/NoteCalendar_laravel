<?php

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

Route::get('/', function () {
    return view('welcome');
});


//login

Route::get('/login', ['App\Http\Controllers\AuthController', 'login'])->name('login');
Route::post('/login/auth/user', ['App\Http\Controllers\AuthController', 'loginAuthUser'])->name('login.auth.user');

Route::get('/logout', ['App\Http\Controllers\AuthController', 'logout'])->name('logout');

//register
Route::get('/register', ['App\Http\Controllers\AuthController', 'register'])->name('register');
Route::post('/register/new/user', ['App\Http\Controllers\AuthController', 'registerNewUser'])->name('register.new.user');


//dashboard
Route::get('/dashboard', ['App\Http\Controllers\DashboardController', 'dashboard'])->name('dashboard');
Route::post('/dashboard/new/event', ['App\Http\Controllers\DashboardController', 'dashboardNewEvent'])->name('dashboard.new.event');
Route::delete('/dashboard/delete/event', ['App\Http\Controllers\DashboardController', 'dashboardRemoveEvent'])->name('dashboard.delete.event');
Route::put('/dashboard/update/event', ['App\Http\Controllers\DashboardController', 'dashboardUpdateEvent'])->name('dashboard.update.event');