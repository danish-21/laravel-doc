<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth:api'])->group(function () {
    Route::get('self', [UserController::class, 'self']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);
    Route::get('users', [UserController::class, 'index']);
    Route::post('change-password', [AuthController::class, 'changePassword']);

});
Route::post('authenticate', [AuthController::class, 'doLogin']);
Route::post('resend-opt', [AuthController::class, 'resendOtp']);
Route::post('users', [UserController::class, 'createUser']);

