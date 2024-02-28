<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('pages.admin.index-customer');
    }


    public function generatePdf()
    {
        // Ambil data pelanggan dari database
        $customers = Transaction::join('customer', 'transaction.customer_id', 'customer.id')
        ->select('customer.id', 'customer.name', 'customer.telp', 'customer.address')
        ->selectRaw('COUNT(transaction.id) as total_transaction')
        ->groupby('customer.id')
        ->get();

        // Mulai membuat laporan PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pages.admin.customer_pdf', ['customers' => $customers]));

        // Atur opsi PDF
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        // Render PDF
        $dompdf->setOptions($options);
        $dompdf->render();

        // Menghasilkan nama file unik untuk laporan
        $filename = 'customer_report_' . time() . '.pdf';

        // Mengirimkan laporan PDF sebagai respons
        return $dompdf->stream($filename);
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
        //
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
