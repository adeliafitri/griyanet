<?php

use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\SalesPackageController;
use App\Http\Controllers\Sales\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

        Route::get('/admin/sales-package', [SalesPackageController::class, 'getAll']);
        Route::post('/admin/sales-package', [SalesPackageController::class, 'store']);

        Route::get('/admin/sales', [SalesController::class, 'getAll']);
        Route::post('/admin/sales', [SalesController::class, 'store']);

        Route::get('/sales/customer', [CustomerController::class, 'getAll']);
        Route::post('/sales/customer', [CustomerController::class, 'store']);
        Route::get('/sales/customer/{id}/edit', [CustomerController::class, 'editCustomer']);
        Route::put('/sales/customer/update', [CustomerController::class, 'updateCustomer']);
        Route::delete('/sales/customer/{id}', [CustomerController::class, 'deleteCustomer']);


