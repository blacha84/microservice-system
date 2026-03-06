<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ActivationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogoutController;


/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});


/*
|--------------------------------------------------------------------------
| Guest routes (only for non-authenticated users)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisterController::class, 'show'])
        ->name('register.form');

    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register');

    Route::get('/login', [LoginController::class, 'show'])
        ->name('login.form');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login');

});


/*
|--------------------------------------------------------------------------
| Registration success
|--------------------------------------------------------------------------
*/

Route::get('/register/success', function () {
    return view('register-success');
})->name('register.success');


/*
|--------------------------------------------------------------------------
| Account activation
|--------------------------------------------------------------------------
*/

Route::get('/activate', [ActivationController::class, 'activate'])
    ->name('activate.account');


/*
|--------------------------------------------------------------------------
| Authenticated routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'show'])
        ->name('dashboard');

    Route::post('/logout', [LogoutController::class, 'logout'])
        ->name('logout');

});
