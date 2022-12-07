@php

$pointIcon = \DB::table('reports')->where('user_id', auth()->user()->id)->count();
// dd($points);

$reports = \DB::table('reports')
            ->join('users', 'users.id', '=', 'reports.user_id')
            ->select('reports.*', 'users.*')
            ->where('status', 2)
            ->orWhere('status', null)
            ->take(5)
            ->orderBy('reports.id', 'desc')
            ->get();

$reportsCount = \DB::table('reports')
            ->where('status', 2)
            ->orWhere('status', null)
            ->get();
            
    $user = auth()->user()->role;

// Role User
// $statusPoint = \App\Models\Point::where('reporting_point', auth()->user()->id)->with('types')->get();

@endphp
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    @if($user == 'user')
      @if(Request::path() == 'reports')
        <meta name="csrf-token" content="{{ csrf_token() }}">
      @endif
    @endif
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Datatables --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/DataTables/datatables.css') }}">
     
    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Report <sup>GCI</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            @if($user == 'admin')
            <li class="nav-item {{ (Request::path() == 'admin/dashboard' ? 'active' : '') }}">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            @else
            <li class="nav-item {{ (Request::path() == 'dashboard' ? 'active' : '') }}">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            @endif

            <!-- Divider -->
            @if($user == 'admin')
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master Data
            </div>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item {{ 
                Request::path() == 'admin/users' ? 'active' : 
                (Request::path() == 'admin/reports' ? 'active' : 
                (Request::path() == 'admin/filter-violation' ? 'active' : 
                (Request::path() == 'admin/verif' ? 'active' : 
                (Request::path() == 'admin/filter-reports' ? 'active' : 
                (Request::path() == 'admin/typesvio' ? 'active' : ''))))) }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Data</span>
                </a>
                <div id="collapseUtilities" class="collapse {{ 
                    Request::path() == 'admin/users' ? 'show' : 
                    (Request::path() == 'admin/reports' ? 'show' : 
                    (Request::path() == 'admin/filter-violation' ? 'show' : 
                    (Request::path() == 'admin/verif' ? 'show' : 
                    (Request::path() == 'admin/filter-reports' ? 'show' : 
                    (Request::path() == 'admin/typesvio' ? 'show' : ''))))) }}" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Data</h6>
                        <a class="collapse-item {{ (Request::path() == 'admin/users' ? 'active' : '') }}" href="{{ route('users.admin') }}">Pengguna</a>
                        <a class="collapse-item {{ (Request::path() == 'admin/reports' ? 'active' : '') }}" href="{{ route('reports.admin') }}">Pelaporan</a>
                        <a class="collapse-item {{ (Request::path() == 'admin/filter-reports' ? 'active' : '') }}" href="{{ route('filter.report.admin') }}">Filter Pelaporan Point</a>
                        <a class="collapse-item {{ (Request::path() == 'admin/filter-violation' ? 'active' : '') }}" href="{{ route('filter.admin') }}">Filter Pelanggaran</a>
                        {{-- <a class="collapse-item" href="{{ route('points.admin') }}">Point Pelanggaran</a> --}}
                        <a class="collapse-item {{ (Request::path() == 'admin/typesvio' ? 'active' : '') }}" href="{{ route('typesVio.admin') }}">Jenis Pelanggaran</a>
                        <a class="collapse-item {{ (Request::path() == 'admin/verif' ? 'active' : '') }}" href="{{ route('admin.reports.verified') }}">Verifikasi</a>
                    </div>
                </div>
            </li>
            @endif

            @if($user == 'user')
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Pengelola Data
            </div>

            @if(auth()->user()->menu_report_status == 0)
            <li class="nav-item {{ (Request::path() == 'reports' ? 'active' : '') }}">
                <a class="nav-link" href="{{ route('user.report') }}">
                    <i class="fas fa-fw fa-flag"></i>
                    <span>Pelaporan</span></a>
            </li>
            @endif

            <li class="nav-item {{ (Request::path() == 'points' ? 'active' : '') }}">
                <a class="nav-link" href="{{ route('user.points') }}">
                    <i class="fas fa-fw fa-sort-numeric-up-alt"></i>
                    <span>Point 
                        @if($pointIcon)
                            <p class="badge badge-primary badge-pill bg-danger"><i class="fas fa-exclamation-circle"></i></p>
                        @endif
                    </span></a>
                    {{-- <span>Point <p><i class="fas fa-exclamation-circle"></p></span></a> --}}

            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            @endif

            <!-- Heading -->
            <div class="sidebar-heading">
                Pengaturan
            </div>

            <li class="nav-item {{ (Request::path() == 'profile' ? 'active' : '') }}">
                <a class="nav-link" href="{{ route('myprofile') }}">
                    <i class="fas fa-fw fa-user-alt"></i>
                    <span>Profil Saya</span></a>
            </li>

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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    {{-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> --}}

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        @if($user == 'user')
                        <input type="hidden" id="idUserLogin" value="{{ auth()->user()->id }}">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter badge-count"></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Laporan Belum di Setujui
                                </h6>
                                <div class="notifUser">
                                    
                                </div>
                                
                                {{-- <div class="dropdown-item d-flex align-items-center">
                                        <div class="small text-gray-500 mr-1"></div>
                                        <span class="font-weight-bold">Pelaporan Kosong</span>
                                    </div> --}}
                                <a class="dropdown-item text-center small text-gray-500" href="{{ route('reports.verification') }}">Tampilkan Semua Laporan</a>
                            </div>
                        </li>

                        {{-- Laporan Pelanggaran yang telah di lakukan oleh user --}}
                        {{-- <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">{{ 'on comming' }}</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Laporan Pelanggaran
                                </h6>
                                @forelse($statusPoint as $sp)
                                <a class="dropdown-item d-flex align-items-center" href="">
                                    <div>
                                        <div class="small text-gray-500">{{ $sp->reports->reporting_date }}</div>
                                        <span class="font-weight-bold">{{ $sp->reports->title }}</span>
                                    </div>
                                </a>
                                @empty
                                    <div class="dropdown-item d-flex align-items-center">
                                            <div class="small text-danger mr-1"></div>
                                            <span class="font-weight-bold">Pelaporan Kosong</span>
                                        </div>
                                    <a class="dropdown-item text-center small text-gray-500" href="{{ route('user.points') }}">Tampilkan Semua Laporan</a>
                                @endforelse
                                
                            </div>
                        </li> --}}
                        @endif

                        @if($user == 'admin')
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">{{ $reportsCount->count() }}</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Pelanggaran Masuk
                                </h6>
                                @forelse($reports as $report)
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.report.detail', $report->id) }}">
                                    <div>
                                        <div class="small text-gray-500"> {{ date('d-m-Y', strtotime($report->reporting_date)) }}</div>
                                        <span class="font-weight-bold">{{ $report->title == null ? "Judul Kosong" : $report->title }}</span>
                                    </div>
                                </a>
                                @empty
                                <div class="dropdown-item d-flex align-items-center">
                                        <div class="small text-gray-500 mr-1"> {{ date('d-m-Y') }}</div>
                                        <span class="font-weight-bold">Pelaporan Kosong</span>
                                    </div>
                                @endforelse
                                <a class="dropdown-item text-center small text-gray-500" href="{{ route('admin.report.verification') }}">Tampilkan Semua Pelanggaran</a>
                            </div>
                        </li>
                        @endif

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->fullname }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets/img/' . auth()->user()->image) }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('myprofile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" id="modalLogout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Report GCI {{ date('Y') }}</span>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keluar Akun?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih tombol "Keluar" jika anda ingin keluar akun.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary buttonLogout">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        CKEDITOR.replace( 'editor1' );
    </script>

    
    <!-- Bootstrap core JavaScript-->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/vendor/DataTables/datatables.js') }}"></script>
    <!-- Page level plugins -->
    {{-- <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script> --}}

    {{-- JS with Page --}}
    @include('partials.page-js')
</body>

</html>
              
