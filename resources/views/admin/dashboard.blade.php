@php
    use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Buku Tamu BKPSDM Dashboard</title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE v4 | Dashboard">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{asset('AdminLTE')}}/dist/css/adminlte.css"><!--end::Required Plugin(AdminLTE)--><!-- apexcharts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.css') }}">


</head> <!--end::Head--> <!--begin::Body-->


<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Start Navbar Links-->
                <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->

                    <!-- User Menu Dropdown -->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{asset('AdminLTE')}}/dist/assets/img/logoProfile.jpg" class="user-image rounded-circle shadow" alt="User Image">
                            <span class="d-none d-md-inline">{{ Auth::guard('admin')->user()->username_admin }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!-- User Image -->
                            <li class="user-header" style="background-color: #03989E; color: #ffffff;">
                                <img src="{{asset('AdminLTE')}}/dist/assets/img/logoProfile.jpg" class="rounded-circle shadow" alt="User Image">
                                <p>
                                    {{ Auth::guard('admin')->user()->username_admin }}
                                    <small>{{ Auth::guard('admin')->user()->role->nama_role }}</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <button type="button" class="btn btn-default btn-flat float-end" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    Sign out
                                </button>
                            </li>
                        </ul>
                    </li>

                    <!-- Modal Konfirmasi -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="background-color: rgb(247, 243, 243);"> <!-- Ganti dengan warna yang diinginkan -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin keluar?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-primary" id="confirmLogout">Keluar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </ul> <!--end::End Navbar Links-->
            </div> <!--end::Container-->
        </nav> <!--end::Header--> <!--begin::Sidebar-->


        <aside class="app-sidebar bg-dark shadow">
            <!-- Sidebar Logo -->
            <div class="sidebar-logo-container">
                <a class="logo-link d-flex flex-column align-items-center">
                    <img src="{{ asset('form/images/bkpsdm.jpg') }}" alt="Logo BKPSDM" class="sidebar-logo">
                    <span class="sidebar-title mt-2">Buku Tamu BKPSDM</span>
                </a>
            </div>

            <!-- Sidebar Menu -->
            <div class="sidebar-menu">
                <nav>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="./dashboard" class="nav-link active">
                                <i class="bi bi-journal nav-icon"></i> Buku Tamu
                            </a>
                        </li>
                        @if(Auth::guard('admin')->user()->id_role == 1)
                        <li class="nav-item">
                            <a href="{{ route('createAdmin') }}" class="nav-link">
                                <i class="bi bi-person-plus nav-icon"></i> Create Admin
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- End: Sidebar -->


        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Dashboard</h3>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header--> <!--begin::App Content-->

            <div class="container-fluid mt-4">
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box bg-pending shadow">
                            <div class="d-flex align-items-center p-3">
                                <div class="small-box-icon me-3">
                                    <i class="bi bi-hourglass-split"></i>
                                </div>
                                <div>
                                    <h3>{{ $pendingCount }}</h3>
                                    <p>Pending</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box bg-process shadow">
                            <div class="d-flex align-items-center p-3">
                                <div class="small-box-icon me-3">
                                    <i class="bi bi-gear"></i>
                                </div>
                                <div>
                                    <h3>{{ $processCount }}</h3>
                                    <p>Process</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box bg-completed shadow">
                            <div class="d-flex align-items-center p-3">
                                <div class="small-box-icon me-3">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div>
                                    <h3>{{ $completedCount }}</h3>
                                    <p>Selesai</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box bg-total shadow">
                            <div class="d-flex align-items-center p-3">
                                <div class="small-box-icon me-3">
                                    <i class="bi bi-bar-chart-fill"></i>
                                </div>
                                <div>
                                    <h3>{{ $totalCount }}</h3>
                                    <p>Jumlah Keseluruhan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        <div class="container-fluid">
            <div class="row w-100 p-0">
                <h3 class="mb-10 text-center">Data Buku Tamu</h3>

                <!-- Filter Date Time dan Status -->
                <form action="{{ route('dashboard.filter') }}" method="GET">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label for="startDate">Dari Tanggal:</label>
                            {{-- <input type="datetime-local" id="startDate" name="startDate" class="form-control"> --}}
                            <input type="datetime-local" id="startDate" name="startDate" class="form-control" value="{{ request('startDate') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="endDate">Sampai Tanggal:</label>
                            {{-- <input type="datetime-local" id="endDate" name="endDate" class="form-control"> --}}
                            <input type="datetime-local" id="endDate" name="endDate" class="form-control" value="{{ request('endDate') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="statusFilter">Status:</label>
                            <select id="statusFilter" name="statusFilter" class="form-select form-select-sm">
                                <option value="">Semua Status</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id_status }}"
                                        {{ request('statusFilter') == $status->id_status ? 'selected' : '' }}>
                                        {{ $status->status_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 align-self-end">
                            <button class="btn btn-primary mt-2" type="submit">Filter</button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-2">Refresh</a>
                        </div>
                    </div>
                </form>


                <div class="table-responsive">
                    <table id="myDataTable" class="table table-striped table-bordered" style="width:100%;">
                        <thead class="table-white">
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Jabatan Pegawai</th>
                                <th>Unit Kerja Pegawai</th>
                                <th>Tujuan Informasi</th>
                                <th>Bidang</th>
                                <th>Layanan</th>
                                <th>Waktu Input</th>
                                <th>Waktu Update</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($dataDashboard->isEmpty())
                                <tr>
                                    <td colspan="12" class="text-center text-muted">Data tidak ditemukan</td>
                                </tr>
                            @else
                                @foreach ($dataDashboard as $dataTamu)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dataTamu->id_buku_tamu }}</td>
                                        <td>{{ $dataTamu->nip }}</td>
                                        <td>{{ $dataTamu->nama_pegawai }}</td>
                                        <td>{{ $dataTamu->jabatan_pegawai }}</td>
                                        <td>{{ $dataTamu->unit_kerja_pegawai }}</td>
                                        <td>{{ $dataTamu->tujuan_informasi }}</td>
                                        <td>{{ $dataTamu->bidang->nama_bidang }}</td>
                                        <td>{{ $dataTamu->layanan->nama_layanan }}</td>
                                        <td>{{ $dataTamu->created_at->timezone('Asia/Jakarta')->format('d-m-Y, H:i:s') }}</td>
                                        <td>{{ $dataTamu->updated_at->timezone('Asia/Jakarta')->format('d-m-Y, H:i:s') }}</td>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-sm
                                                    @if($dataTamu->id_status == 1) btn-warning
                                                    @elseif($dataTamu->id_status == 2) btn-info
                                                    @elseif($dataTamu->id_status == 3) btn-success
                                                    @else btn-secondary
                                                    @endif"
                                                data-bs-toggle="modal"
                                                data-bs-target="#updateStatusModal-{{ $dataTamu->id_dashboard_admin }}">
                                                @if($dataTamu->id_status == 1)
                                                    Pending
                                                @elseif($dataTamu->id_status == 2)
                                                    Process
                                                @elseif($dataTamu->id_status == 3)
                                                    Selesai
                                                @else
                                                    Ubah Status
                                                @endif
                                            </button>
                                            <div class="modal fade" id="updateStatusModal-{{ $dataTamu->id_dashboard_admin }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Ubah Status</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('updateStatus', $dataTamu->id_dashboard_admin) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <select class="form-select" name="id_status">
                                                                    @foreach ($statuses as $status)
                                                                        <option value="{{ $status->id_status }}" {{ $dataTamu->id_status == $status->id_status ? 'selected' : '' }}>
                                                                            {{ $status->status_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
                        </div> <!-- /.Start col -->
                    </div> <!-- /.row (main row) -->
                </div> <!--end::Container-->
            </div> <!--end::App Content-->


        </main> <!--end::App Main--> <!--begin::Footer-->
    </div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{asset('AdminLTE')}}/dist/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script> <!--end::OverlayScrollbars Configure--> <!-- OPTIONAL SCRIPTS --> <!-- sortablejs -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ=" crossorigin="anonymous"></script> <!-- sortablejs -->
    <script>
        const connectedSortables =
            document.querySelectorAll(".connectedSortable");
        connectedSortables.forEach((connectedSortable) => {
            let sortable = new Sortable(connectedSortable, {
                group: "shared",
                handle: ".card-header",
            });
        });

        const cardHeaders = document.querySelectorAll(
            ".connectedSortable .card-header",
        );
        cardHeaders.forEach((cardHeader) => {
            cardHeader.style.cursor = "move";
        });
    </script> <!-- apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script> <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js" integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js" integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script> <!-- jsvectormap -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/dataTables.js') }}"></script>
    <script>
        let table = $('#myDataTable').DataTable();
    </script>
    <script>
        $(document).ready(function() {
            let table = $('#myDataTable').DataTable();
        table.on('draw', function() {
            $('table th, table td').css('font-size', '18px');
            $('.btn-sm').css({
                'font-size': '16px',
                'padding': '8px 12px'
            });
        });
    });
    </script>

    <script>
        document.getElementById('confirmLogout').addEventListener('click', function() {
            document.getElementById('logout-form').submit(); // Mengirim form ketika dikonfirmasi
        });
    </script>

</body><!--end::Body-->

</html>
