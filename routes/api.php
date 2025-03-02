<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('register', [AuthController::class, 'register'])->name('auth.register');

Route::middleware(['auth:api'])->group(function () {
    Route::get('me', [AuthController::class, 'me'])->name('auth.user');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});


Route::apiResource('settings', SettingController::class)
	->middleware('auth:api');

Route::apiResource('users', UserController::class)
	->middleware('auth:api');

Route::apiResource('stores', StoreController::class)
	->middleware('auth:api');