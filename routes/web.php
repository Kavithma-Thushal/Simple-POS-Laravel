<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/customerRoute', function () {
    return view('customer');
});

Route::get('/itemRoute', [ItemController::class, 'itemManagement']);

Route::get('/orderRoute', [OrderController::class, 'orderManagement'])->name('placeOrder');
