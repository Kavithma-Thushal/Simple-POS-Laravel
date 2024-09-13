<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class PlaceOrderController extends Controller
{
    public function viewPlaceOrder()
    {
        return view('placeOrder');
    }

    public function generateOrderId()
    {
        $lastCustomerId = Customer::orderBy('id', 'desc')->value('id');

        if (!$lastCustomerId) {
            $lastCustomerId = "ORD-000";
        }

        return response()->json(['data' => $lastCustomerId]);
    }
}
