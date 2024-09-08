<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function getCustomerView()
    {
        return view('customer');
    }

    public function saveCustomer(Request $request)
    {
        // Create a new customer
        $customer = new Customer();
        $customer->id = $request->input('id');
        $customer->name = $request->input('name');
        $customer->address = $request->input('address');
        $customer->salary = $request->input('salary');

        // Save customer to the database
        $customer->save();

        return response()->json(['message' => 'Customer Saved Successfully...!'], 201);
    }
}
