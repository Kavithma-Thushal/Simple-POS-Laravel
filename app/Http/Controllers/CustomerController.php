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
        $validatedData = $request->validate([
            'id' => 'required|string',
            'name' => 'required|string',
            'address' => 'required|string',
            'salary' => 'required|numeric',
        ]);

        Customer::updateOrCreate(
            ['id' => $request->input('id')],
            $validatedData
        );

        return response()->json(['message' => 'Customer Saved Successfully...!'], 201);
    }

    public function searchCustomer(Request $request)
    {
        $query = $request->input('query');
        $customers = Customer::where('name', 'like', "%{$query}%")
            ->orWhere('address', 'like', "%{$query}%")
            ->get();

        return response()->json($customers);
    }

    public function updateCustomer(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|string',
            'name' => 'required|string',
            'address' => 'required|string',
            'salary' => 'required|numeric',
        ]);

        $customer = Customer::find($request->input('id'));
        if ($customer) {
            $customer->update($validatedData);
            return response()->json(['message' => 'Customer Updated Successfully!']);
        }

        return response()->json(['message' => 'Customer Not Found!'], 404);
    }

    public function deleteCustomer(Request $request)
    {
        $customer = Customer::find($request->input('id'));
        if ($customer) {
            $customer->delete();
            return response()->json(['message' => 'Customer Deleted Successfully!']);
        }

        return response()->json(['message' => 'Customer Not Found!'], 404);
    }

    public function getAllCustomers()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }
}
