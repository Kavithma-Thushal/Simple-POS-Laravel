<?php

namespace App\Http\Controllers;

class PlaceOrderController extends Controller
{
    public function getPlaceOrderView()
    {
        return view('placeOrder');
    }
}
