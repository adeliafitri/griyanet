@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row">
                <div class="col-md-10 align-self-center">
                    <h6>Sales Package</h6>
                </div>
                <div class="col-md-2">
                        <button type="button" class="btn btn-block btn-dark btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#modal-form">Add data</button>
                        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                              <div class="modal-body p-0">
                                <div class="card card-plain">
                                  <div class="card-header pb-0 text-left">
                                    <h3 class="font-weight-bolder fs-5 text-center text-warning text-gradient">Add Data Sales Package</h3>
                                    {{-- <p class="mb-0">Enter your email and password to sign in</p> --}}
                                  </div>
                                  <div class="card-body">
                                    <form id="addDataForm" role="form text-left">
                                      <label>Package Name</label>
                                      <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="package_name" placeholder="Package Name" aria-label="Package Name" aria-describedby="email-addon">
                                      </div>
                                      <label>Description</label>
                                      <div class="input-group mb-3">
                                        <textarea class="form-control" name="description" placeholder="Description" aria-label="Description" aria-describedby="password-addon"></textarea>
                                      </div>
                                      <label>Price</label>
                                      <div class="input-group mb-3">
                                        <input type="number" class="form-control" name="price" placeholder="Price" aria-label="Price" aria-describedby="price-addon">
                                      </div>
                                      <div class="text-center">
                                        <button type="button" class="btn btn-round bg-gradient-warning btn-md w-80 mt-4 mb-0" onclick="addData()">Save</button>
                                      </div>
                                    </form>
                                  </div>
                                  <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    {{-- <p class="mb-4 text-sm mx-auto">
                                      Don't have an account?
                                      <a href="javascript:;" class="text-info text-gradient font-weight-bold">Sign up</a>
                                    </p> --}}
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
            <div class="table-responsive p-0" id="salesPackageTable">
              <table class="table align-items-center mb-0">

              </table>
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
      </div>
    </div>
  </div>
@endsection

@section('script')
<script>
    function addData() {
        var form = $('#addDataForm');
        $.ajax({
            type: 'POST',
            url: '/api/admin/sales-package',
            data: form.serialize(),
            success: function(response) {
                Swal.fire({
                    title: "Success!",
                    text: response.success,
                    icon: "success"
                }).then((result) => {
                    // Check if the user clicked "OK"
                    if (result.isConfirmed) {
                        // Redirect to the desired URL
                        window.location.reload();
                    };
                });
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle error here
                console.error(xhr.responseText);
            }
        });
    }

    $(document).ready(function() {
        // Panggil fungsi untuk memuat data saat halaman dimuat
        loadData();
    });

    function loadData() {
        $.ajax({
            type: 'GET',
            url: '/api/admin/sales-package',
            success: function(response) {
                // Panggil fungsi untuk membangun tabel dengan data yang diterima
                buildTable(response.data);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function buildTable(data) {
        var table = '<table class="table align-items-center mb-0"><thead><tr><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Package Name</th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th><th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th><th class="text-secondary opacity-7"></th></tr></thead><tbody>';

        // Loop melalui data dan bangun baris tabel untuk setiap entri
        for (var i = 0; i < data.length; i++) {
            table += '<tr><td class="text-sm font-weight-bold" style="padding-left: 20px;">' + data[i].package_name + '</td><td class="text-sm">' + data[i].description + '</td><td class="align-middle text-center text-sm">' + data[i].price + '</td><td class="align-middle"><a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">Edit</a></td></tr>';
        }

        table += '</tbody></table>';

        // Masukkan tabel yang dibangun ke dalam elemen dengan id salesPackageTable
        $('#salesPackageTable').html(table);
    }
</script>
@endsection
