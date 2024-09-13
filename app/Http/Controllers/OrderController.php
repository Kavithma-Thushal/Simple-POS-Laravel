<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function viewOrder()
    {
        return view('order');
    }

    public function generateOrderId()
    {
        $lastCustomerId = Order::orderBy('orderId', 'desc')->value('orderId');

        if (!$lastCustomerId) {
            $lastCustomerId = "ORD-000";
        }

        return response()->json(['data' => $lastCustomerId]);
    }
}
