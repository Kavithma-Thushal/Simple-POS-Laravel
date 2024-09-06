<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PlaceOrderController;
use App\Http\Controllers\OrderDetailsController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/customerRoute', [CustomerController::class, 'customerManagement'])->name('customer');

Route::get('/itemRoute', [ItemController::class, 'itemManagement'])->name('item');

Route::get('/placeOrderRoute', [PlaceOrderController::class, 'placeOrderManagement'])->name('placeOrder');

Route::get('/orderDetailsRoute', [OrderDetailsController::class, 'orderDetailsManagement'])->name('orderDetails');
