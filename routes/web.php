<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/customerRoute', function () {
    return view('customer');
});

Route::get('/itemRoute', [ItemController::class, 'itemManagement']);
