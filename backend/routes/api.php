<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ScanController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PlantController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group( function () {
    Route::post('verify-otp', [LoginController::class, 'login']);
    Route::post('resend-code', [LoginController::class, 'resend']);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::apiResource('login', LoginController::class);
    Route::apiResource('register', RegisterController::class);
});

Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('scanner', ScanController::class);
    Route::apiResource('plants', PlantController::class);

    Route::get('cart_seller', [CartController::class, 'cartSeller']);
    Route::apiResource('carts', CartController::class);
    Route::apiResource('checkout', CheckoutController::class);
});