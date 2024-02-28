<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\SalesPackage;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $total_customer = Customer::count();
        $total_package = SalesPackage::count();
        $total_sales = User::where('role', 'sales')->count();
        return view('pages.admin.dashboard', compact('total_customer', 'total_package', 'total_sales'));
    }
}
