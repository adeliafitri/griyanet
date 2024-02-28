<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesPackage;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('pages.admin.index-sales');
    }

    public function getAll() {
        try {
            $sales = User::where('role', 'sales')->get();

            return response()->json([
                'data' => $sales,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'nip' => 'required|string',
            'password' => 'required',
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }

        try {
            User::create([
                'name' => $request->name,
                'nip' => $request->nip,
                'password' => Hash::make($request->password),
                'role' => 'sales'
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
