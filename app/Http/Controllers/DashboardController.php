<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function getDashboardView()
    {
        return view('dashboard');
    }
}
