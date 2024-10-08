<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsController;

Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'viewDashboard')->name('view-dashboard');
});

Route::controller(CustomerController::class)->group(function () {
    Route::get('/view-customer-route', 'viewCustomer')->name('view-customer');
    Route::post('/save-customer-route', 'saveCustomer')->name('save-customer');
    Route::get('/search-customer-route', 'searchCustomer')->name('search-customer');
    Route::put('/update-customer-route', 'updateCustomer')->name('update-customer');
    Route::delete('/delete-customer-route', 'deleteCustomer')->name('delete-customer');
    Route::get('/get-all-customers-route', 'getAllCustomers')->name('get-all-customers');
    Route::get('/generate-customer-id-route', 'generateCustomerId')->name('generate-customer-id');
    Route::get('/customer-count-route', 'getCustomerCount')->name('customer-count');
});

Route::controller(ItemController::class)->group(function () {
    Route::get('/view-item-route', 'viewItem')->name('view-item');
    Route::post('/save-item-route', 'saveItem')->name('save-item');
    Route::get('/search-item-route', 'searchItem')->name('search-item');
    Route::put('/update-item-route', 'updateItem')->name('update-item');
    Route::delete('/delete-item-route', 'deleteItem')->name('delete-item');
    Route::get('/get-all-items-route', 'getAllItems')->name('get-all-items');
    Route::get('/generate-item-code-route', 'generateItemCode')->name('generate-item-code');
    Route::get('/item-count-route', 'getItemCount')->name('item-count');
});

Route::controller(OrderController::class)->group(function () {
    Route::get('/view-order-route', 'viewOrder')->name('view-order');
    Route::post('/place-order-route', 'placeOrder')->name('place-order');
    Route::get('/generate-order-id-route', 'generateOrderId')->name('generate-order-id');
    Route::get('/order-count-route', 'getOrderCount')->name('order-count');
});

Route::controller(OrderDetailsController::class)->group(function () {
    Route::get('/view-order-details-route', 'viewOrderDetails')->name('view-order-details');
    Route::get('/get-order-details-route', 'getOrderDetails')->name('get-order-details');
});
