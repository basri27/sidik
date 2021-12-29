<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LMMC - @yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('img/klinik.png') }}" type="image/x-icon">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    @yield('css')
    <!-- <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dashboard/datatables/dataTables.bootstrap4.css') }}"> -->

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin_profil') }}">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('img/klinik.png') }}" style="width: 3em;">
                </div>
                <div class="sidebar-brand-text mx-3">SIDIK</div>
            </a>

            <!-- Divider -->

            <!-- Nav Item - Dashboard -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Beranda</span></a>
            </li> -->

            <!-- Divider -->

            <div class="sidebar-heading">
                Menu
            </div>
            <hr class="sidebar-divider my-0">

            @yield('menu')

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-dark bg-info topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i style="color: black" class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
                        <div class="input-group">
                        <h4 style="color: white"><b>@yield('subhead')</b></h4>
                        </div>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <!-- <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                Counter - Alerts
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            Dropdown - Alerts
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-reply"></i>&nbsp; Ke Beranda</a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white-600 small"><b>
                                {{ Auth::user()->pasien->nama }}
                                </b></span>
                                <img class="img-profile rounded-circle" src="{{ asset('img/klinik.png') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                    @yield('content')

            </div>
            <!-- End of Main Content -->
    
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SIDIK 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/dashboard/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/dashboard/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/dashboard/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/dashboard/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/dashboard/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/dashboard/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/dashboard/demo/chart-pie-demo.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/dashboard/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/dashboard/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

</body>

</html>