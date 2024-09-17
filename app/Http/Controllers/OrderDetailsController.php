<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderDetailsController extends Controller
{
    public function viewOrderDetails()
    {
        return view('order_details');
    }

    public function getOrderDetails()
    {
        $ordersList = Order::with(['customer', 'orderDetails.item'])->get();

        if ($ordersList->isNotEmpty()) {
            // Initialize an array to store the order DTOs
            $orderDTOList = [];

            // Loop through each order
            foreach ($ordersList as $order) {
                $orderDTO = [
                    'orderId' => $order->orderId,
                    'customerId' => $order->customer->id,
                    'orderDetailsList' => []
                ];

                // Loop through the order details
                foreach ($order->orderDetails as $orderDetails) {
                    $orderDetailsDTO = [
                        'itemCode' => $orderDetails->item->code,
                        'buyQty' => $orderDetails->buyQty,
                        'total' => $orderDetails->total
                    ];

                    // Add order details DTO to the list
                    $orderDTO['orderDetailsList'][] = $orderDetailsDTO;
                }

                // Add order DTO to the list
                $orderDTOList[] = $orderDTO;
            }

            return response()->json(['data' => $orderDTOList]);
        } else {
            return response()->json(['message' => 'No Orders Yet...!'], 404);
        }
    }
}
