<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function() {
    Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login');
    Route::post('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout']);
    Route::post('/refresh', [\App\Http\Controllers\Auth\AuthController::class, 'refresh']);
});

Route::prefix('dashboard')->group(function() {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index']);
});

Route::apiResource('device', \App\Http\Controllers\Device\DeviceController::class)->only(['index', 'show', 'destroy']);
Route::apiResource('device.parameters', \App\Http\Controllers\Device\DeviceParameterController::class);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
