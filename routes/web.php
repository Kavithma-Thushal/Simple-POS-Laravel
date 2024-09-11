<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PlaceOrderController;
use App\Http\Controllers\OrderDetailsController;

Route::get('/', [DashboardController::class, 'viewDashboard'])->name('view-dashboard');

Route::controller(CustomerController::class)->group(function () {
    Route::get('/view-customer-route', 'viewCustomer')->name('view-customer');
    Route::post('/save-customer-route', 'saveCustomer')->name('save-customer');
    Route::get('/search-customer-route', 'searchCustomer')->name('search-customer');
    Route::put('/update-customer-route', 'updateCustomer')->name('update-customer');
    Route::delete('/delete-customer-route', 'deleteCustomer')->name('delete-customer');
    Route::get('/get-all-customers-route', 'getAllCustomers')->name('get-all-customers');
    Route::get('/generate-customer-id-route', 'generateCustomerId')->name('generate-customer-id');
});

Route::get('/view-item-route', [ItemController::class, 'viewItem'])->name('view-item');
Route::get('/view-place-order-route', [PlaceOrderController::class, 'viewPlaceOrder'])->name('view-place-order');
Route::get('/view-order-details-route', [OrderDetailsController::class, 'viewOrderDetails'])->name('view-order-details');
