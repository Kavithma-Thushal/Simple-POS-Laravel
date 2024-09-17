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
            return response()->json(['message' => 'Customer Saved Successfully...!']);
        } else {
            return response()->json(['message' => 'Duplicate Customer Id: ' . $validatedData['id']], 400);
        }
    }

    public function searchCustomer(Request $request)
    {
        $customer = Customer::where('id', $request['id'])->first();
        if ($customer) {
            return response()->json(['data' => $customer]);
        } else {
            return response()->json(['message' => 'Customer Not Found...!'], 404);
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
            return response()->json(['message' => 'Customer Updated Successfully...!']);
        } else {
            return response()->json(['message' => 'Customer Not Found: ' . $validatedData['id']], 404);
        }
    }

    public function deleteCustomer(Request $request)
    {
        $customer = Customer::find($request['id']);
        if ($customer) {
            $customer->delete();
            return response()->json(['message' => 'Customer Deleted Successfully...!']);
        } else {
            return response()->json(['message' => 'Customer Not Found: ' . $request['id']], 404);
        }
    }

    public function getAllCustomers()
    {
        $customers = Customer::all();
        if ($customers->isNotEmpty()) {
            return response()->json(['data' => $customers]);
        } else {
            return response()->json(['message' => 'No Customers Found...!'], 404);
        }
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
        return response()->json(['data' => Customer::count()]);
    }
}
