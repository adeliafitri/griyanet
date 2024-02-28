<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\SalesPackage;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function Index() {
        $sales_packages = SalesPackage::pluck('package_name', 'id');
        $user = Auth::user();
        // dd($user);
        return view('pages.sales.customer', compact('sales_packages', 'user'));
    }

    public function getAll() {
        try {
            $customer = Transaction::join('customer', 'transaction.customer_id', 'customer.id')
            ->select('customer.id', 'customer.name', 'customer.telp', 'customer.address')
            ->selectRaw('COUNT(transaction.id) as total_transaction')
            ->groupby('customer.id')
            ->get();

            return response()->json([
                'data' => $customer,
                'success' => 'Data found',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to show data:'.$e->getMessage()
            ], 500);
        }

    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'telp' => 'required',
            'address' => 'required',
            'sales_package' => 'required|exists:sales_packages,id',
            'file_ktp.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            // 'file_rumah.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $image = null;

            if ($request->hasFile('file_ktp')) {
                $image = time() . '_' . $request->file('file_ktp')->getClientOriginalName();
                $request->file('file_ktp')->storeAs('public/image', $image);
            }

            // Buat array untuk menyimpan nama file rumah
            $houseImages = [];

            if ($request->hasFile('file_rumah')) {
                foreach ($request->file('file_rumah') as $photo) {
                    $imageName = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                    $photo->storeAs('public/image', $imageName);
                    $houseImages[] = $imageName;
                }
            }
            // dd($image);
            $customer = Customer::create([
                'name' => $request->name,
                'telp' => $request->telp,
                'address' => $request->address,
                'ktp_photo' => $image
            ]);

            Transaction::create([
                'customer_id' => $customer->id,
                'sales_id' => $request->sales_id,
                'package_id' => $request->sales_package,
                'house_photo' => json_encode($houseImages),
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

    public function editCustomer($id)
{
    // Mengambil data customer berdasarkan ID
    $customer = Customer::findOrFail($id);

    // Mengirim data customer sebagai respons JSON
    return response()->json($customer);
}

    public function updateCustomer(Request $request)
    {
        // Validasi input jika diperlukan
        $validatedData = $request->validate([
            'name' => 'required|string',
            'telp' => 'required|string',
            'address' => 'required|string',
            // Tambahkan validasi untuk field lain jika diperlukan
        ]);

        // Lakukan update data di database berdasarkan ID
        $customer = Customer::findOrFail($request->customerId);
        $customer->update($request->all());

        // Kirim respons sukses
        return response()->json(['success' => 'Customer data updated successfully']);
    }

    public function deleteCustomer($id)
{
    // Temukan data customer berdasarkan ID dan hapus
    $customer = Customer::findOrFail($id);
    $customer->delete();
    Transaction::where('customer_id', $id)->delete();

    // Kirim respons sukses
    return response()->json(['success' => 'Customer data deleted successfully']);
}

}
