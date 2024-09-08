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
        // Validate request data
        $validated = $request->validate([
            'id' => 'required|string|unique:customers,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0'
        ]);

        // Create a new customer
        $customer = new Customer();
        $customer->id = $validated['id'];
        $customer->name = $validated['name'];
        $customer->address = $validated['address'];
        $customer->salary = $validated['salary'];

        // Save customer to database
        $customer->save();

        return response()->json(['message' => 'Customer Saved Successfully...!'], 201);
    }
}
