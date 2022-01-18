<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{asset('BMKG.png')}}">
    <title>Van Trophy</title>
    <!-- <style>
        body{
            background-image:url('gedung.jpg');
            background-position: center center;
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
			}
    </style> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

    <!-- Tell the browser to be responsive to screen width -->
    @yield('head')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adminlte/fontawesome-free/css/all.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="/adminlte/plugins/ekko-lightbox/ekko-lightbox.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/adminlte/css/adminlte.min.css">
    <!-- DataTable -->
    <link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <h3 class="font-weight-bold">Aplikasi Sistem Penjualan dan Stok Barang Van Trophy </h3>
            </ul>
            <div class="ml-3 relative">
          </div>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
              
                <!-- Messages Dropdown Menu -->
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-user mr-2"></i> &nbsp;<span>{{auth()->user()->name}}</span> &nbsp;<i
                            class="icon-submenu lnr lnr-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">Profil</span>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                            <i class="fas fa-user mr-2"></i> Lihat Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        {{-- <a href="/logout" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                        </a> --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item"
                                     onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                  <i class="fas fa-sign-out-alt    "></i>
                                  {{ __('Keluar') }}
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-1">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="mt-3 pb-3 mb-1">
                    <div></div><br>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @if (auth()->user()->role == 'admin')
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link @yield('menuBeranda')">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="nav-icon fas fa-home"></i>
                                    </div>
                                    <div class="col-9">
                                        <p>
                                            Beranda
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link @yield('menuBarang')">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fas fa-boxes    "></i>
                                    </div>
                                    <div class="col-9">
                                        <p>
                                            Transaksi
                                        </p>
                                    </div>
                                    <i class="right fas fa-angle-left"></i>
                                </div>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item ml-3 ">
                                    <a href="/masuk" class="nav-link  @yield('menuMasuk')">
                                        <i class="far fa-envelope nav-icon"></i>
                                        <p>Barang Masuk</p>
                                    </a>
                                </li>
                                <li class="nav-item ml-3">
                                    <a href="/barang" class="nav-link @yield('menuKeluar')">
                                        <i class="far fa-envelope-open nav-icon"></i>
                                        <p>Barang Keluar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/barang" class="nav-link @yield('menuStok')">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fas fa-users" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-9">
                                        <p>
                                            Stok Barang
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="nav-icon fas fa-mail-bulk"></i>
                                    </div>
                                    <div class="col-9">
                                        <p>
                                            Pembelian
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="/supplier" class="nav-link @yield('menuSupplier')">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fas fa-shipping-fast    "></i>
                                    </div>
                                    <div class="col-9">
                                        <p>
                                            Supplier
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-9">
                                        <p>
                                            Kelola User
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        
                @endif
                @if (auth()->user()->role == 'pelanggan')
                        
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Permintaan Aset
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/permintaanAset" class="nav-link">
                                        <i class="far fa-envelope nav-icon"></i>
                                        <p>Baru</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/permintaanAset/diterima" class="nav-link">
                                        <i class="far fa-envelope-open nav-icon"></i>
                                        <p>Disetujui</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                @endif
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        
        <div class="content-wrapper" style="background: #19219219; padding: 15px 15px 15px 15px ">

            @yield('content')

        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>sistem pendataan penjualan dan stok barang Van trophy</b>
            </div>
            Copyright &copy; 2021 | by : Satria Duta
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- page script -->
    <script>
        $(function () {
            $("#table").DataTable();
        });

        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function (event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });
        });
    </script>
    @yield('script')
    <!-- jQuery -->
    <script src="/adminlte/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/adminlte/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/adminlte/js/adminlte.min.js"></script>
    <!-- Ekko Lightbox -->
    <script src="/adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <!-- Filterizr-->
    <script src="/adminlte/plugins/filterizr/jquery.filterizr.min.js"></script>
    <!-- Data Table -->
    <script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/adminlte/js/demo.js"></script>
    </div>
    </div>
</body>
</html>
