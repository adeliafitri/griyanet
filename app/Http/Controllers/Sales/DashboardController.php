<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $total_customer = Customer::count();
        return view('pages.sales.dashboard', compact('total_customer'));
    }
}
