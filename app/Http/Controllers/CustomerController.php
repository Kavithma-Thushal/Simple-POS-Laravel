<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function viewCustomer()
    {
        return view('customer');
    }

    public function saveCustomer(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|string|unique:customers,id',
            'name' => 'required|string',
            'address' => 'required|string',
            'salary' => 'required|numeric',
        ]);

        Customer::create($validatedData);
        return response()->json(['message' => 'Customer Saved Successfully...!'], 201);
    }

    public function searchCustomer(Request $request)
    {
        $query = $request->input('id');
        $customer = Customer::where('id', $query)->first();
        if ($customer) {
            return response()->json(['data' => $customer]);
        } else {
            return response()->json(['message' => 'Customer Not Found...!'], 404);
        }
    }

    public function updateCustomer(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|string',
            'name' => 'required|string',
            'address' => 'required|string',
            'salary' => 'required|numeric',
        ]);

        $customer = Customer::findOrFail($validatedData['id']);
        $customer->update($validatedData);
        return response()->json(['message' => 'Customer Updated Successfully...!'], 201);
    }

    public function deleteCustomer(Request $request)
    {
        $customer = Customer::find($request->input('id'));
        if ($customer) {
            $customer->delete();
            return response()->json(['message' => 'Customer Deleted Successfully!']);
        }
        return response()->json(['message' => 'Customer Not Found...!'], 404);
    }

    public function getAllCustomers()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    public function generateCustomerId()
    {
        // Fetch the last customer ID from the database
        $lastCustomerId = Customer::orderBy('id', 'desc')->value('id');

        if (!$lastCustomerId) {
            $lastCustomerId = "C00-000";
        }

        return response()->json([
            'data' => $lastCustomerId,
            'message' => 'Last customer ID Retrieved Successfully...!'
        ], 200);
    }
}
