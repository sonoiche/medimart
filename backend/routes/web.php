<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('client')->middleware(['auth:web'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('orders', OrderController::class);
});

Route::resource('account', AccountController::class);

require __DIR__.'/admin-routes.php';