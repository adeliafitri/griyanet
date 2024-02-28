<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesPackage;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalesPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.sales_package.index');
    }

    public function getAll() {
        try {
            $sales_package = SalesPackage::all();

            return response()->json([
                'data' => $sales_package,
                'success' => 'Data found',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to show data'
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'package_name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required',
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }

        try {
            SalesPackage::create([
                'package_name' => $request->package_name,
                'description' => $request->description,
                'price' => $request->price,
            ]);

            return response()->json([
                'success' => 'Data Successfully Added!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'Failed to add data: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
