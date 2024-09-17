<?php

namespace App\Http\Controllers;

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
        // Validate the request
        $validatedData = $request->validate([
            'code' => 'required|string',
            'description' => 'required|string',
            'unitPrice' => 'required|numeric',
            'qtyOnHand' => 'required|integer',
        ]);

        $item = Item::where('code', $validatedData['code'])->exists();
        if (!$item) {
            Item::create($validatedData);
            return response()->json(
                ['message' => 'Item Saved Successfully...!']
            );
        } else {
            return response()->json(
                ['message' => 'Duplicate Item Code: ' . $validatedData['code']],
                400
            );
        }
    }

    public function searchItem(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'id' => 'required|string',
        ]);

        $item = Item::where('code', $validatedData['id'])->first();
        if ($item) {
            return response()->json(
                ['data' => $item]
            );
        } else {
            return response()->json(
                ['message' => 'Item Not Found...!'],
                404
            );
        }
    }

    public function updateItem(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'code' => 'required|string',
            'description' => 'required|string',
            'unitPrice' => 'required|numeric',
            'qtyOnHand' => 'required|integer',
        ]);

        $item = Item::find($validatedData['code']);
        if ($item) {
            $item->update($validatedData);
            return response()->json(
                ['message' => 'Item Updated Successfully...!']
            );
        } else {
            return response()->json(
                ['message' => 'Item Not Found: ' . $validatedData['code']],
                404
            );
        }
    }

    public function deleteItem(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'id' => 'required|string',
        ]);

        $item = Item::find($validatedData['id']);
        if ($item) {
            $item->delete();
            return response()->json(
                ['message' => 'Item Deleted Successfully...!']
            );
        } else {
            return response()->json(
                ['message' => 'Item Not Found: ' . $validatedData['id']],
                404
            );
        }
    }

    public function getAllItems()
    {
        $items = Item::all();
        if ($items->isNotEmpty()) {
            return response()->json(
                ['data' => $items]
            );
        } else {
            return response()->json(
                ['message' => 'No Items Found...!'],
                404
            );
        }
    }

    public function generateItemCode()
    {
        $lastItemCode = Item::orderBy('code', 'desc')->value('code');
        if (!$lastItemCode) {
            $lastItemCode = "I00-000";
        }
        return response()->json(
            ['data' => $lastItemCode]
        );
    }

    public function getItemCount()
    {
        return response()->json(
            ['data' => Item::count()]
        );
    }
}
