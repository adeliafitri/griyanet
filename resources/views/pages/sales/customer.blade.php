@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row">
                <div class="col-md-10 align-self-center">
                    <h6>Customer</h6>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-block btn-dark btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#modal-form">Add data</button>
                    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-body p-0">
                            <div class="card card-plain">
                              <div class="card-header pb-0 text-left">
                                <h3 class="font-weight-bolder fs-5 text-center text-warning text-gradient">Add Data Customer</h3>
                                {{-- <p class="mb-0">Enter your email and password to sign in</p> --}}
                              </div>
                              <div class="card-body">
                                <form method="post" role="form text-left" id="addDataForm" enctype="multipart/form-data">
                                    @csrf
                                  <label>Name</label>
                                  <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="name" placeholder="Name" aria-label="Name" aria-describedby="name-addon">
                                  </div>
                                  <label>Telephone</label>
                                  <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="telp" placeholder="Telephone" aria-label="Telephone" aria-describedby="name-addon">
                                  </div>
                                  <label>Address</label>
                                  <div class="input-group mb-3">
                                    <textarea class="form-control" name="address" placeholder="Address" aria-label="Address" aria-describedby="nip-addon"></textarea>
                                  </div>
                                  <label>Sales Package</label>
                                  <select class="form-select" aria-label="Default select example" name="sales_package">
                                    <option selected>Choose the package</option>
                                    @foreach ($sales_packages as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                  </select>
                                  <label>Foto KTP</label>
                                  <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="file_ktp" id="fileInput" placeholder="File" aria-label="File" aria-describedby="file-ktp-addon">
                                  </div>
                                  <label>Foto Rumah</label>
                                  <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="file_rumah[]" placeholder="File" aria-label="File" aria-describedby="file-rumah-addon" multiple>
                                  </div>
                                  <input type="hidden" name="sales_id" value="{{ $user->id }}">
                                  <div class="text-center">
                                    <button type="button" class="btn btn-round bg-gradient-warning btn-md w-80 mt-4 mb-0" onclick="addData()">Save</button>
                                  </div>
                                </form>
                              </div>
                              <div class="card-footer text-center pt-0 px-lg-2 px-1">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0" id="customerTable">

            </div>
          </div>
          <div class="card-footer pagination-container justify-content-center">
            <ul class="pagination pagination-warning">
              <li class="page-item">
                <a class="page-link" href="javascript:;" aria-label="Previous">
                  <span aria-hidden="true"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                </a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="javascript:;">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:;">2</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:;">3</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:;">4</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:;">5</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:;" aria-label="Next">
                  <span aria-hidden="true"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Data Customer</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form Edit Data -->
          <form id="editDataForm">
            @csrf
            <input type="hidden" id="editCustomerId" name="customerId">
            <label for="editName" class="form-label">Name</label>
            <input type="text" class="form-control" id="editName" name="name">
            <label for="editTelp" class="form-label">Phone</label>
            <input type="text" class="form-control" id="editTelp" name="telp">
            <label for="editAddress" class="form-label">Addres</label>
            <textarea type="text" class="form-control" id="editAddress" name="address"></textarea>
            <button type="submit" class="btn btn-warning mt-3">Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

      </div>
    </div>
  </div>
@endsection

@section('script')
<script>
    function addData() {
        var form = $('#addDataForm')[0]; // Ambil elemen DOM dari formulir
    var formData = new FormData(form); // Buat objek FormData dan tambahkan data formulir

    // Ambil file gambar dan tambahkan ke formData
    var ktpFiles = $('#addDataForm input[name="file_ktp"]')[0].files;
    var rumahFiles = $('#addDataForm input[name="file_rumah[]"]')[0].files;
    formData.append('file_ktp', ktpFiles[0]); // Ambil file KTP
    for (var i = 0; i < rumahFiles.length; i++) {
        formData.append('file_rumah[]', rumahFiles[i]); // Ambil file rumah (bisa lebih dari satu)
    }

    $.ajax({
        type: 'POST',
        url: '/api/sales/customer',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            Swal.fire({
                title: "Success!",
                text: response.success,
                icon: "success"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                };
            });
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
    }

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
            table += '<tr><td class="text-sm font-weight-bold" style="padding-left: 20px;">' + data[i].name + '</td><td class="text-sm">' + data[i].telp + '</td><td class="text-sm">' + data[i].address + '</td><td class="text-sm">' + data[i].total_transaction + '</td><td class="align-middle d-flex"><a href="javascript:;" class="text-secondary font-weight-bold text-xs me-2" onclick="editData(' + data[i].id + ')" data-toggle="modal" data-target="#editModal">Edit</a><a href="javascript:;" class="text-secondary font-weight-bold text-xs" onclick="deleteData(' + data[i].id + ')" data-toggle="tooltip" data-original-title="delete">Delete</a></td></tr>';
        }

        table += '</tbody></table>';

        // Masukkan tabel yang dibangun ke dalam elemen dengan id salesPackageTable
        $('#customerTable').html(table);
    }

    // Tambahkan ini di dalam section 'script'

function editData(id) {
    // Lakukan request AJAX untuk mendapatkan data customer yang akan diedit
    $.ajax({
        type: 'GET',
        url: '/api/sales/customer/' + id + '/edit',
        success: function(response) {
            // Isi modal edit dengan data customer yang diterima
            $('#editCustomerId').val(response.id);
            $('#editName').val(response.name);
            $('#editTelp').val(response.telp);
            $('#editAddress').val(response.address);
            // Isi field lain jika diperlukan

            // Tampilkan modal edit
            $('#editModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

// Fungsi untuk menangani submit form edit
$('#editDataForm').submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'PUT',
        url: '/api/sales/customer/update',
        data: formData,
        success: function(response) {
            // Tutup modal edit setelah berhasil menyimpan perubahan
            $('#editModal').modal('hide');
            // Tampilkan pesan sukses
            Swal.fire({
                title: "Success!",
                text: response.success,
                icon: "success"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                };
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

function deleteData(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'DELETE',
                url: '/api/sales/customer/' + id,
                success: function(response) {
                    Swal.fire(
                        'Deleted!',
                        'Your data has been deleted.',
                        'success'
                    ).then(() => {
                        window.location.reload(); // Reload halaman setelah berhasil dihapus
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire(
                        'Error!',
                        'Failed to delete data.',
                        'error'
                    );
                }
            });
        }
    });
}


</script>
@endsection
