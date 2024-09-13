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
        $validatedData = $request->validate([
            'code' => 'required|string|unique:items,code',
            'description' => 'required|string',
            'unitPrice' => 'required|numeric',
            'qtyOnHand' => 'required|integer',
        ]);

        Item::create($validatedData);
        return response()->json(
            ['message' => 'Item Saved Successfully...!'],
            201);
    }

    public function searchItem(Request $request)
    {
        $query = $request->input('id');
        $item = Item::where('code', $query)->first();
        if ($item) {
            return response()->json(['data' => $item]);
        } else {
            return response()->json(
                ['message' => 'Item Not Found...!'],
                404);
        }
    }

    public function updateItem(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|string',
            'description' => 'required|string',
            'unitPrice' => 'required|numeric',
            'qtyOnHand' => 'required|integer',
        ]);

        $item = Item::findOrFail($validatedData['code']);
        $item->update($validatedData);
        return response()->json(
            ['message' => 'Item Updated Successfully...!'],
            201);
    }

    public function deleteItem(Request $request)
    {
        $item = Item::find($request->input('id'));
        if ($item) {
            $item->delete();
            return response()->json(['message' => 'Item Deleted Successfully...!']);
        } else {
            return response()->json(
                ['message' => 'Item Not Found...!'],
                404);
        }
    }

    public function getAllItems()
    {
        $item = Item::all();
        return response()->json($item);
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
        $totalItems = Item::count();
        return response()->json(['data' => $totalItems]);
    }
}
