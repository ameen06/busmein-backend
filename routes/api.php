<?php

use App\Http\Controllers\Api\ApisForBookingController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\DestinationController;
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

Route::prefix('auth')->group(function(){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('verify_otp', [AuthController::class, 'verify']);
});

Route::get('destinations', [DestinationController::class, 'index']);

Route::post('getBusForRoute', [ApisForBookingController::class, 'getBusForRoute']);
Route::post('getBoardingPoints', [ApisForBookingController::class, 'getBoardingPoints']);
Route::post('getDroppingPoints', [ApisForBookingController::class, 'getDroppingPoints']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('auth/logout', [AuthController::class, 'logout']);

    // bookings
    Route::get('bookings', [BookingController::class, 'index']);
    Route::post('bookings', [BookingController::class, 'create']);

});
