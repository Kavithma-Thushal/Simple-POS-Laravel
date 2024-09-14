<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetails;

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

    public function getOrderCount()
    {
        $totalOrders = Order::count();
        return response()->json(['data' => $totalOrders]);
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'orderId' => 'required|string',
            'customerId' => 'required|string',
            'orderDetailsList' => 'required|array',
            'orderDetailsList.*.itemCode' => 'required|string',
            'orderDetailsList.*.buyQty' => 'required|string',
            'orderDetailsList.*.total' => 'required|string',
        ]);

        // Check if the OrderId already exists
        if (Order::where('orderId', $request->orderId)->exists()) {
            return response()->json([
                'message' => 'Duplicate Order Id: ' . $request->orderId
            ], 409);
        }

        // Find the Customer
        $customer = Customer::find($request->customerId);
        if (!$customer) {
            return response()->json([
                'message' => 'Customer Not Found: ' . $request->customerId
            ], 404);
        }

        // Create the Order
        $order = new Order();
        $order->orderId = $request->orderId;
        $order->customerId = $customer->id;
        $order->save();

        // Prepare OrderDetails and Update Item Quantities
        foreach ($request->orderDetailsList as $orderDetail) {
            $item = Item::find($orderDetail['itemCode']);
            if (!$item) {
                return response()->json([
                    'message' => 'Item Not Found: ' . $orderDetail['itemCode']
                ], 404);
            }

            // Convert buyQty to integer
            $buyQty = intval($orderDetail['buyQty']);
            if ($item->qtyOnHand < $buyQty) {
                return response()->json([
                    'message' => 'Not Enough Stock For Item: ' . $item->description
                ], 400);
            }

            // Create OrderDetails
            $orderDetailEntry = new OrderDetails();
            $orderDetailEntry->orderId = $order->orderId;
            $orderDetailEntry->itemCode = $item->code;
            $orderDetailEntry->buyQty = $buyQty;
            $orderDetailEntry->total = $item->unitPrice * $buyQty;
            $orderDetailEntry->save();

            // Update Item Quantity
            $item->qtyOnHand -= $buyQty;
            $item->save();
        }

        return response()->json([
            'message' => 'Order Placed Successfully...!'
        ], 200);
    }
}
