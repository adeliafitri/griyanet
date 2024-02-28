@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row">
                <div class="col-md-8 align-self-center">
                    <h6>Customer</h6>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('generatePdf') }}" class="btn btn-dark btn-sm active" role="button" aria-pressed="true"><i class="fas fa-file-download me-2"></i>Download Pdf</a>
                </div>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0" id="customerTable">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script>
        $(document).ready(function() {
        // Panggil fungsi untuk memuat data saat halaman dimuat
        // loadData();
        loadDataCustomer();
    });

    function loadDataCustomer() {
        $.ajax({
            type: 'GET',
            url: '/api/sales/customer',
            success: function(response) {
                // Panggil fungsi untuk membangun tabel dengan data yang diterima
                buildTableCustomer(response.data);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function buildTableCustomer(data) {
        var table = '<table class="table align-items-center mb-0"><thead><tr><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone</th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address</th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Transaction</th><th class="text-secondary opacity-7"></th></tr></thead><tbody>';

        // Loop melalui data dan bangun baris tabel untuk setiap entri
        for (var i = 0; i < data.length; i++) {
            table += '<tr><td class="text-sm font-weight-bold" style="padding-left: 20px;">' + data[i].name + '</td><td class="text-sm">' + data[i].telp + '</td><td class="text-sm">' + data[i].address + '</td><td class="text-sm">' + data[i].total_transaction + '</td></tr>';
        }

        table += '</tbody></table>';

        // Masukkan tabel yang dibangun ke dalam elemen dengan id salesPackageTable
        $('#customerTable').html(table);
    }
</script>
@endsection
