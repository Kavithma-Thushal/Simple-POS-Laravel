<?php

namespace App\Http\Controllers;

class CustomerController extends Controller
{
    public function getCustomerView()
    {
        return view('customer');
    }
}
