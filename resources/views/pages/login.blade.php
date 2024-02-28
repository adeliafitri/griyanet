<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
</head>

<body class="">
  {{-- <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{ route('dashboard') }}">
              GriyaNet
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="../pages/dashboard.html">
                    <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                    Dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="../pages/profile.html">
                    <i class="fa fa-user opacity-6 text-dark me-1"></i>
                    Profile
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="../pages/sign-up.html">
                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                    Sign Up
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="../pages/sign-in.html">
                    <i class="fas fa-key opacity-6 text-dark me-1"></i>
                    Sign In
                  </a>
                </li>
              </ul>
              <ul class="navbar-nav d-lg-block d-none">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/product/argon-dashboard" class="btn btn-sm mb-0 me-1 btn-warning">Free Download</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div> --}}
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Sign In</h4>
                  <p class="mb-0">Enter your NIP and password to sign in</p>
                </div>
                <div class="card-body">
                  <form action="{{ route('proses-login') }}" role="form" id="loginForm" method="post">
                    @csrf
                    <div class="mb-3">
                      <input type="text" class="form-control form-control-lg" placeholder="NIP" aria-label="NIP" name="nip">
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" name="password">
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg btn-warning btn-lg w-100 mt-4 mb-0">Sign In</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-warning h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
          background-size: cover;">
                <span class="mask bg-gradient-warning opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new currency"</h4>
                <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  @include('layouts.script')
  {{-- <script>
    function submitLogin() {
    var formData = $('#loginForm').serialize(); // Mengambil data formulir
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/api/login', // URL endpoint login
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken // Menambahkan token CSRF ke header permintaan
        },
        data: formData, // Data formulir yang akan dikirim
        success: function(response) {
            // Berhasil masuk, redirect ke halaman dashboard
            localStorage.setItem('access_token', response.token);
            window.location.href = response.redirect;
        },
        error: function(xhr, status, error) {
            // Menangani kesalahan validasi atau kesalahan lainnya
            var err = JSON.parse(xhr.responseText);
            alert(err.error);
        }
    });
}
  </script> --}}
</body>

</html>
