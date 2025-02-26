<?php

use App\Http\Controllers\Api\AuthController;
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


Route::apiResource('settings', App\Http\Controllers\Api\SettingController::class)
	->middleware('auth:api');

Route::apiResource('setting-types', App\Http\Controllers\Api\SettingTypeController::class)
    ->middleware('auth:api');