<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function viewDashboard()
    {
        return view('dashboard');
    }
}
