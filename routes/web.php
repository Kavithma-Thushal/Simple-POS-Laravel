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
    Route::get('/customer-count-route', 'customerCount')->name('customer-count');
});

Route::controller(ItemController::class)->group(function () {
    Route::get('/view-item-route', 'viewItem')->name('view-item');
    Route::post('/save-item-route', 'saveItem')->name('save-item');
    Route::get('/search-item-route', 'searchItem')->name('search-item');
    Route::put('/update-item-route', 'updateItem')->name('update-item');
    Route::delete('/delete-item-route', 'deleteItem')->name('delete-item');
    Route::get('/get-all-items-route', 'getAllItems')->name('get-all-items');
    Route::get('/generate-item-code-route', 'generateItemCode')->name('generate-item-code');
    Route::get('/item-count-route', 'itemCount')->name('item-count');
});

Route::get('/view-place-order-route', [PlaceOrderController::class, 'viewPlaceOrder'])->name('view-place-order');
Route::get('/view-order-details-route', [OrderDetailsController::class, 'viewOrderDetails'])->name('view-order-details');
