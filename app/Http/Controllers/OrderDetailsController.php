<?php

namespace App\Http\Controllers;

class OrderDetailsController extends Controller
{
    public function getOrderDetailsView()
    {
        return view('orderDetails');
    }
}
