<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PlaceOrderController;
use App\Http\Controllers\OrderDetailsController;

Route::get('/', [DashboardController::class, 'getDashboardView'])->name('dashboard-view');

Route::get('/customer-view-route', [CustomerController::class, 'getCustomerView'])->name('customer-view');
Route::post('/customer-save-route', [CustomerController::class, 'saveCustomer'])->name('customer-save');
Route::get('/customer-search-route', [CustomerController::class, 'searchCustomer'])->name('customer-search');
Route::put('/customer-update-route', [CustomerController::class, 'updateCustomer'])->name('customer-update');
Route::delete('/customer-delete-route', [CustomerController::class, 'deleteCustomer'])->name('customer-delete');
Route::get('/customers-get-all-route', [CustomerController::class, 'getAllCustomers'])->name('customers-get-all');

Route::get('/item-view-route', [ItemController::class, 'getItemView'])->name('item-view');
Route::get('/placer-order-view-route', [PlaceOrderController::class, 'getPlaceOrderView'])->name('place-order-view');
Route::get('/order-details-view-route', [OrderDetailsController::class, 'getOrderDetailsView'])->name('order-details-view');
