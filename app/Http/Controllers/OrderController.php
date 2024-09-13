<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class OrderController extends Controller
{
    public function viewPlaceOrder()
    {
        return view('order');
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
