<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function viewItem()
    {
        return view('item');
    }

    public function saveItem(Request $request)
    {
        $rules = [
            'code' => ['required', 'regex:/^I\d{2}-\d{3}$/'],
            'description' => ['required', 'regex:/^[A-Za-z\s\'-]{4,}$/'],
            'unitPrice' => ['required', 'numeric', 'min:0'],
            'qtyOnHand' => ['required', 'integer', 'min:0'],
        ];

        $messages = [
            'code.regex' => 'Item Code format must be "I00-001", "I12-345"',
            'description.regex' => 'Description must contain at least 4 letters',
            'unitPrice.min' => 'Unit Price must be a positive value or zero',
            'qtyOnHand.min' => 'Qty On Hand must be a positive value or zero',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();
        $item = Item::where('code', $validatedData['code'])->exists();
        if (!$item) {
            Item::create($validatedData);
            return response()->json(['message' => 'Item Saved Successfully...!']);
        } else {
            return response()->json(['message' => 'Duplicate Item Code: ' . $validatedData['code']], 400);
        }
    }

    public function searchItem(Request $request)
    {
        $item = Item::where('code', $request['id'])->first();
        if ($item) {
            return response()->json(['data' => $item]);
        } else {
            return response()->json(['message' => 'Item Not Found...!'], 404);
        }
    }

    public function updateItem(Request $request)
    {
        $rules = [
            'code' => ['required', 'regex:/^I\d{2}-\d{3}$/'],
            'description' => ['required', 'regex:/^[A-Za-z\s\'-]{4,}$/'],
            'unitPrice' => ['required', 'numeric', 'min:0'],
            'qtyOnHand' => ['required', 'integer', 'min:0'],
        ];

        $messages = [
            'code.regex' => 'Item Code format must be "I00-001", "I12-345"',
            'description.regex' => 'Description must contain at least 4 letters',
            'unitPrice.min' => 'Unit Price must be a positive value or zero',
            'qtyOnHand.min' => 'Qty On Hand must be a positive value or zero',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();
        $item = Item::find($validatedData['code']);
        if ($item) {
            $item->update($validatedData);
            return response()->json(['message' => 'Item Updated Successfully...!']);
        } else {
            return response()->json(['message' => 'Item Not Found: ' . $validatedData['code']], 404);
        }
    }

    public function deleteItem(Request $request)
    {
        $item = Item::find($request['id']);
        if ($item) {
            $item->delete();
            return response()->json(['message' => 'Item Deleted Successfully...!']);
        } else {
            return response()->json(['message' => 'Item Not Found: ' . $request['id']], 404);
        }
    }

    public function getAllItems()
    {
        $items = Item::all();
        if ($items->isNotEmpty()) {
            return response()->json(['data' => $items]);
        } else {
            return response()->json(['message' => 'No Items Found...!'], 404);
        }
    }

    public function generateItemCode()
    {
        $lastItemCode = Item::orderBy('code', 'desc')->value('code');
        if (!$lastItemCode) {
            $lastItemCode = "I00-000";
        }
        return response()->json(['data' => $lastItemCode]);
    }

    public function getItemCount()
    {
        return response()->json(['data' => Item::count()]);
    }
}
