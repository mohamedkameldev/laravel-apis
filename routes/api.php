<?php

use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\MessageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

#--------------------------------- AUTH
Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth:sanctum');
});

#--------------------------------- SETTINGS
Route::get('settings', SettingsController::class);

#--------------------------------- LOCATIONS
Route::get('cities', CityController::class);
Route::get('city-districts/{city}', DistrictController::class);

#--------------------------------- MESSAGES
Route::post('new-message', MessageController::class);

#--------------------------------- ADS
Route::prefix('ads')->controller(AdController::class)->group(function () {
    Route::get('', 'index');
    Route::get('latest/{num}', 'latest');
    Route::get('search', 'search');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('getAds', 'getAllUserAds');
        Route::post('create', 'create');
        Route::put('update/{adId}', 'update');
        Route::delete('delete/{adId}', 'delete');
    });
});
