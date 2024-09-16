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
        // Validate the request
        $validatedData = $request->validate([
            'id' => 'required|string',
            'name' => 'required|string',
            'address' => 'required|string',
            'salary' => 'required|numeric',
        ]);

        $customer = Customer::where('id', $validatedData['id'])->exists();
        if (!$customer) {
            Customer::create($validatedData);
            return response()->json(
                ['message' => 'Customer Saved Successfully...!'],
                200
            );
        } else {
            return response()->json(
                ['message' => 'Duplicate Customer Id: ' . $validatedData['id']],
                400
            );
        }
    }

    public function searchCustomer(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'id' => 'required|string',
        ]);

        $customer = Customer::where('id', $validatedData['id'])->first();
        if ($customer) {
            return response()->json(
                ['data' => $customer],
                200
            );
        } else {
            return response()->json(
                ['message' => 'Customer Not Found: ' . $validatedData['id']],
                404
            );
        }
    }

    public function updateCustomer(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'id' => 'required|string',
            'name' => 'required|string',
            'address' => 'required|string',
            'salary' => 'required|numeric',
        ]);

        $customer = Customer::find($validatedData['id']);
        if ($customer) {
            $customer->update($validatedData);
            return response()->json(
                ['message' => 'Customer Updated Successfully...!'],
                200
            );
        } else {
            return response()->json(
                ['message' => 'Customer Not Found: ' . $validatedData['id']],
                400
            );
        }
    }

    public function deleteCustomer(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'id' => 'required|string',
        ]);

        $customer = Customer::find($validatedData['id']);
        if ($customer) {
            $customer->delete();
            return response()->json(
                ['message' => 'Customer Deleted Successfully...!'],
                200
            );
        } else {
            return response()->json(
                ['message' => 'Customer Not Found: ' . $validatedData['id']],
                404
            );
        }
    }

    public function getAllCustomers()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    public function generateCustomerId()
    {
        $lastCustomerId = Customer::orderBy('id', 'desc')->value('id');

        if (!$lastCustomerId) {
            $lastCustomerId = "C00-000";
        }

        return response()->json(['data' => $lastCustomerId]);
    }

    public function getCustomerCount()
    {
        $totalCustomers = Customer::count();
        return response()->json(['data' => $totalCustomers]);
    }
}
