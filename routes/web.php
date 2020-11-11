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
    return view('auth/login');
});

Route::get('/resetpassword', [App\Http\Controllers\PasswordController::class, 'reset'])->name('reset');

Route::post('/resetpassword', [App\Http\Controllers\PasswordController::class, 'changePassword'])->name('resetPassword');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user', [App\Http\Controllers\HomeController::class, 'getUser']);

Route::post('/user/update', [App\Http\Controllers\HomeController::class, 'updateUser']);

Route::get('/pending', [App\Http\Controllers\BookingController::class, 'pendingRequest']);

Route::get('/request', [App\Http\Controllers\BookingController::class, 'myRequest']);

Route::get('/fleet', [App\Http\Controllers\BookingController::class, 'getFleet']);

Route::get('/driver', [App\Http\Controllers\BookingController::class, 'getDriver']);

Route::get('/notification', [App\Http\Controllers\BookingController::class, 'getNotification']);

Route::post('/{id}/accept', [App\Http\Controllers\BookingController::class, 'acceptRequest']);

Route::post('/{id}/cancel', [App\Http\Controllers\BookingController::class, 'cancelRequest']);

Route::post('/{id}/complete', [App\Http\Controllers\BookingController::class, 'completeRequest']);

Route::post('/notification/clear', [App\Http\Controllers\BookingController::class, 'clearNotification']);

