<?php

use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\MessageController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

#--------------------------------- SETTINGS
Route::get('settings', SettingsController::class);

#--------------------------------- LOCATIONS
Route::get('cities', CityController::class);
Route::get('city-districts/{city}', DistrictController::class);

#--------------------------------- MESSAGES
Route::post('new-message', MessageController::class);
