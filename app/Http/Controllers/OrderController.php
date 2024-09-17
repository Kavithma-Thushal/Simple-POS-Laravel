<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

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

    public function placeOrder(Request $request)
    {
        $request->validate([
            'orderId' => 'required|string',
            'customerId' => 'required|string',
            'orderDetailsList' => 'required|array',
            'orderDetailsList.*.itemCode' => 'required|string',
            'orderDetailsList.*.buyQty' => 'required|integer',
            'orderDetailsList.*.total' => 'required|numeric',
        ]);

        // Check if Customer exists
        $customer = Customer::find($request->customerId);
        if (!$customer) {
            return response()->json(['message' => 'Customer Not Found: ' . $request->customerId], 404);
        }

        // Check if all Items exist
        foreach ($request->orderDetailsList as $orderDetail) {
            $item = Item::find($orderDetail['itemCode']);
            if (!$item) {
                return response()->json(['message' => 'Item Not Found: ' . $orderDetail['itemCode']], 404);
            }
        }

        // Check Order Id
        if (Order::where('orderId', $request->orderId)->exists()) {
            return response()->json(['message' => 'Duplicate Order Id: ' . $request->orderId], 400);
        }

        // Create the Order
        $order = new Order();
        $order->orderId = $request->orderId;
        $order->customerId = $customer->id;
        $order->save();

        // Prepare OrderDetails and Update Item Qty
        foreach ($request->orderDetailsList as $orderDetail) {
            $item = Item::find($orderDetail['itemCode']);

            // Convert buyQty to integer
            $buyQty = intval($orderDetail['buyQty']);
            if ($item->qtyOnHand < $buyQty) {
                return response()->json(['message' => 'Not Enough Stock For Item: ' . $item->description], 400);
            }

            // Create OrderDetails
            $orderDetailEntry = new OrderDetails();
            $orderDetailEntry->orderId = $order->orderId;
            $orderDetailEntry->itemCode = $item->code;
            $orderDetailEntry->buyQty = $buyQty;
            $orderDetailEntry->total = $item->unitPrice * $buyQty;
            $orderDetailEntry->save();

            // Update Item Qty
            $item->qtyOnHand -= $buyQty;
            $item->save();
        }

        return response()->json(['message' => 'Order Placed Successfully...!']);
    }

    public function generateOrderId()
    {
        $lastOrderId = Order::orderBy('orderId', 'desc')->value('orderId');
        if (!$lastOrderId) {
            $lastOrderId = "ORD-000";
        }
        return response()->json(['data' => $lastOrderId]);
    }

    public function getOrderCount()
    {
        return response()->json(['data' => Order::count()]);
    }
}
