<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PlaceOrderController;
use App\Http\Controllers\OrderDetailsController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/customer-route', [CustomerController::class, 'customerManagement'])->name('customer-management');

Route::get('/item-route', [ItemController::class, 'itemManagement'])->name('item-management');

Route::get('/placer-order-route', [PlaceOrderController::class, 'placeOrderManagement'])->name('place-order-management');

Route::get('/order-details-route', [OrderDetailsController::class, 'orderDetailsManagement'])->name('order-details-management');
