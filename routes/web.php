<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/itemRoute', [ItemController::class, 'itemManagement']);

Route::get('/orderRoute', [OrderController::class, 'orderManagement'])->name('placeOrder');

Route::get('/customerRoute', [CustomerController::class, 'customerManagement'])->name('customer');
