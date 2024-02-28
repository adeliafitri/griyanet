<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\SalesPackageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Sales\CustomerController as SalesCustomerController;
use App\Http\Controllers\Sales\DashboardController as SalesDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('proses-login');

Route::group(['middleware' => 'auth'], function() {
    // Route::group(['middleware' => 'role:admin'], function () {
    Route::middleware(['userAkses:admin'])->group(function () {
        Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('admin/sales-package', [SalesPackageController::class, 'index'])->name('salesPackage');
        Route::get('admin/sales', [SalesController::class, 'index'])->name('sales');
        Route::get('admin/customer',[CustomerController::class, 'index'])->name('customer');
        Route::get('admin/customer/pdf', [CustomerController::class, 'generatePdf'])->name('generatePdf');
    });

    Route::middleware(['userAkses:sales'])->group(function () {
        Route::get('sales/dashboard', [SalesDashboardController::class, 'index'])->name('sales.dashboard');

        // Route::get('admin/sales-package', [SalesPackageController::class, 'index'])->name('salesPackage');
        // Route::get('admin/sales', [SalesController::class, 'index'])->name('sales');
        Route::get('sales/customer',[SalesCustomerController::class, 'index'])->name('sales.customer');
        // Route::post('/sales/customer', [CustomerController::class, 'store'])->name('sales.addCustomer');

    });
    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

