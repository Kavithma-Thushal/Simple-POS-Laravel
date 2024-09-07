<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PlaceOrderController;
use App\Http\Controllers\OrderDetailsController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard-management');

Route::get('/customer-route', [CustomerController::class, 'getCustomerView'])->name('customer-management');
Route::get('/item-route', [ItemController::class, 'getItemView'])->name('item-management');
Route::get('/placer-order-route', [PlaceOrderController::class, 'getPlaceOrderView'])->name('place-order-management');
Route::get('/order-details-route', [OrderDetailsController::class, 'getOrderDetailsView'])->name('order-details-management');
