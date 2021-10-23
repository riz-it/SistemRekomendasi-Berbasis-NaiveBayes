<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/mdi/css/materialdesignicons.css') }}">
    <!-- endinject -->
    <!-- vendor css for this page -->
    <!-- End vendor css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/shared/style.css') }}">
    <!-- endinject -->
    <!-- Layout style -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo_1/style.css') }}">
    <!-- Layout style -->
    <link rel="shortcut icon" href="{{ asset('asssets/images/favicon.ico') }}" />

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
    {{-- <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"> --}}
    <style>
        .panel-white {
            color: #fff;
        }

        a {
            text-decoration: none
        }

        .xd {
            background-color: #FBFCFD;
        }

        .text-panel {
            color: black;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 120%;
        }

    </style>
</head>

<body>
    <div class="authentication-theme auth-style_1">


        <div class="row">
            <div class="col-lg-5 col-md-7 col-sm-9 col-11 mx-auto">
                <div class="grid">
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-12 logo-section">
                                <a href="../../index.html" class="logo">
                                    <img src="{{ asset('assets/images/login_icon.png') }}" alt="logo" />
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-7 col-md-8 col-sm-9 col-12 mx-auto form-wrapper">
                                @if (Session::get('fail'))
                                    <div class="alert alert-danger d-flex justify-content-center">
                                        {{ Session::get('fail') }}
                                    </div>
                                @endif
                                @if (Session::get('success'))
                                    <div class="alert alert-success d-flex justify-content-center">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <form class="user" action="{{ url('verified_login') }}" method="POST" id="logForm">
                                    @csrf
                                    <div class="form-group input-rounded">
                                        <input type="text" autocomplete="off" class="form-control" name="username"
                                            placeholder="Username" />
                                    </div>
                                    <div class="form-group input-rounded">
                                        <input type="password" autocomplete="off" class="form-control" name="password"
                                            placeholder="Password" />
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block"> Login </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="auth_footer">
            <p class="text-muted text-center">© Hamdalah Jaya 2019</p>
        </div>
    </div>
    <!--page body ends -->
    <!-- SCRIPT LOADING START FORM HERE /////////////-->
    <!-- plugins:js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/vendors/js/core.js') }}"></script>
    <!-- endinject -->
    <!-- Vendor Js For This Page Ends-->
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/charts/chartjs.addon.js') }}"></script>
    <!-- Vendor Js For This Page Ends-->
    <!-- build:js -->
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    {{-- javascript --}}
    @stack('script')
    <!-- endbuild -->
</body>

</html>
