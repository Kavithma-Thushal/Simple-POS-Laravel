<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function itemManagement()
    {
        return view('itemManagement');
    }
}
