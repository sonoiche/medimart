<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth:web'])->group( function () {
    Route::resource('admin-products', ProductController::class);
    Route::resource('admin-transactions', TransactionController::class);
    
    Route::put('admin-users/{id}', [UserController::class , 'updateUser']);
    Route::resource('admin-users', UserController::class);
});