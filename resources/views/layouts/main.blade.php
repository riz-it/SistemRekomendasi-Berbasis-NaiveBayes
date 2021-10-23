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
        .jumbotron {
            background-image: url("https://i2.wp.com/kominfo.cilacapkab.go.id/wp-content/uploads/2019/12/background-biru-multi-gradasi-scaled.png?ssl=1");
            background-size: cover;
        }

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

<body class="header-fixed">
    <nav class="t-header">
        <div class="t-header-content-wrapper">

            <div class="t-header-content">
                <button class="t-header-toggler t-header-mobile-toggler d-block d-lg-none">
                    <i class="mdi panel-white mdi-menu"></i>
                </button>
                <ul class="nav n ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="appsDropdown" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-apps mdi-1x"></i>
                        </a>
                        <div class="dropdown-menu navbar-dropdown dropdown-menu-right" aria-labelledby="appsDropdown">
                            <div class="dropdown-header">
                                <h6 class="dropdown-title">Features</h6>
                            </div>
                            <div class="dropdown-body border-top pt-0">
                                <a href="{{ url('/dashboard') }}" class="dropdown-grid">
                                    <i class="grid-icon mdi mdi-jira mdi-2x"></i>
                                    <span class="grid-tittle">Dashboard</span>
                                </a>
                                <a href="{{ url('/data') }}" class="dropdown-grid">
                                    <i class="grid-icon mdi mdi-trello mdi-2x"></i>
                                    <span class="grid-tittle">Data</span>
                                </a>
                                <a href="{{ url('/progress') }}" class="dropdown-grid">
                                    <i class="grid-icon mdi mdi-artstation mdi-2x"></i>
                                    <span class="grid-tittle">Progress</span>
                                </a>
                                <a href="{{ url('/output') }}" class="dropdown-grid">
                                    <i class="grid-icon mdi mdi-bitbucket mdi-2x"></i>
                                    <span class="grid-tittle">Output</span>
                                </a>
                            </div>
                            <div class="dropdown-footer">
                                <a href="{{ url('/logout') }}">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- partial -->
    <div class="page-body">
        <!-- partial:partials/_sidebar.html -->
        <div class="sidebar">
            <ul class="navigation-menu">
                <div class="user-profile">
                    <div class="display-avatar animated-avatar">
                        <img class="profile-img img-lg rounded-circle" src="{{ asset('assets/images/user.png') }}"
                            alt="profile image">
                    </div>
                    <div class="info-wrapper">
                        <p class="user-name">{{ Auth::user()->name }}</p>
                    </div>
                </div>
                <li class="nav-category-divider">DOCS</li>
                <li class="{{ Request::segment(1) === 'dashboard' ? 'active' : null }}">
                    <a href="{{ url('/dashboard') }}">
                        <span class="link-title">Dashboard</span>
                        <i class="mdi mdi-asterisk link-icon"></i>
                    </a>
                </li>
                <li class="nav-category-divider">Features</li>
                <li class="{{ Request::segment(1) === 'data' ? 'active' : null }}">
                    <a href="{{ url('/data') }}">
                        <span class="link-title">Data</span>
                        <i class="mdi mdi-database-plus link-icon"></i>
                    </a>
                </li>
                <li class="{{ Request::segment(1) === 'progress' || Request::segment(1) === 'output' ? 'active' : null }}
                            ">
                    <a href="#sample-pages" data-toggle="collapse" aria-expanded="false">
                        <span class="link-title">Output</span>
                        <i class="mdi mdi-flask link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu" id="sample-pages">
                        <li>
                            <a href="{{ url('/progress') }}">Progress</a>
                        </li>
                        <li>
                            <a href="{{ url('/output') }}">Prediction</a>
                        </li>
                    </ul>
                </li>
                <hr>
                <li>
                    <a href="{{ url('/logout') }}">
                        <span class="link-title">Logout</span>
                        <i class="mdi mdi-logout link-icon"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- partial -->
        <div class="page-content-wrapper">
            <div class="page-content-wrapper-inner">
                <div class="content-viewport">
                    @yield('header')
                    @yield('content')
                </div>
            </div>

        </div>
        <!-- page content ends -->
    </div>
    @yield('modal')
    @include('sweetalert::alert')

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
