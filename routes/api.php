<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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
    Route::put('users/{id}', [UserController::class, 'updateUser']);
    Route::get('users', [UserController::class, 'index']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::post('categories', [CategoryController::class, 'create']);
    Route::post('carts', [CartController::class, 'addToCart']);
    Route::get('carts', [CartController::class, 'getAllCartData']);
    Route::put('carts/{id}', [CartController::class, 'updateCartDetail']);
    Route::post('orders', [OrderController::class, 'create']);
    Route::post('products', [ProductController::class, 'bulkCreate']);
    Route::post('user-address', [UserController::class, 'createUserAddress']);




});
Route::post('authenticate', [AuthController::class, 'doLogin']);
Route::post('resend-opt', [AuthController::class, 'resendOtp']);
Route::post('users', [UserController::class, 'createUser']);
Route::get('categories', [CategoryController::class, 'index']);
Route::delete('categories/{id}', [CategoryController::class, 'destroy']);
Route::get('attributes', [CategoryController::class, 'getName']);
Route::put('categories/{id}/status', [CategoryController::class, 'updateStatus']);
Route::get('products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);
Route::post('files', [FileController::class, 'store']);
Route::get('video', [FileController::class, 'downloadVideosFromPlaylist']);






