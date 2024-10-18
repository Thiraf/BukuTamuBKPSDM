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
    <link rel="stylesheet" href="{{asset('AdminLTE')}}//dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
    <link rel="stylesheet" href="{{asset('AdminLTE')}}//jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.css">

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> <!-- Muat CSS eksternal -->


</head> <!--end::Head--> <!--begin::Body-->

<!-- Toast Notification -->
<div aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
    @if(session('success'))
        <div class="toast show" id="successToast" data-bs-delay="5000" style="min-width: 300px; background-color: #28a745; color: white; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">
            <div class="toast-header" style="background-color: transparent; border-bottom: none; color: white;">
                <i class="fa fa-check-circle" style="font-size: 1.5rem; margin-right: 9px;"></i>
                <strong class="me-auto">Sukses</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" style="color: white;"></button>
            </div>
            <div class="toast-body" style="font-size: 1.2rem;">
                {{ session('success') }}
            </div>
        </div>
    @endif
</div>




<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Start Navbar Links-->
                <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->

                    <!-- Fullscreen Toggle -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i>
                        </a>
                    </li>

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
                                    {{ Auth::guard('admin')->user()->username_admin }}  <!-- Nama Username Admin -->
                                    <small>{{ Auth::guard('admin')->user()->role->nama_role }}</small>  <!-- Role Admin -->
                                </p>
                            </li>
                            <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-default btn-flat float-end">Sign out</button>
                                </form>
                            </li>
                            <!-- Tombol Profile dan Logout -->
                        </ul>
                    </li>
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
                            <input type="datetime-local" id="startDate" name="startDate" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="endDate">Sampai Tanggal:</label>
                            <input type="datetime-local" id="endDate" name="endDate" class="form-control">
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
                                <th>NIK</th>
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
                                        <td>{{ $dataTamu->nik }}</td>
                                        <td>{{ $dataTamu->nama_pegawai }}</td>
                                        <td>{{ $dataTamu->jabatan_pegawai }}</td>
                                        <td>{{ $dataTamu->unit_kerja_pegawai }}</td>
                                        <td>{{ $dataTamu->tujuan_informasi }}</td>
                                        <td>{{ $dataTamu->bidang->nama_bidang }}</td>
                                        <td>{{ $dataTamu->layanan->nama_layanan }}</td>
                                        <td>{{ $dataTamu->created_at->format('d-m-Y, H:i:s') }}</td>
                                        <td>{{ $dataTamu->updated_at->format('d-m-Y, H:i:s') }}</td>
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
    <script>
        // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
        // IT'S ALL JUST JUNK FOR DEMO
        // ++++++++++++++++++++++++++++++++++++++++++

        const sales_chart_options = {
            series: [{
                    name: "Digital Goods",
                    data: [28, 48, 40, 19, 86, 27, 90],
                },
                {
                    name: "Electronics",
                    data: [65, 59, 80, 81, 56, 55, 40],
                },
            ],
            chart: {
                height: 300,
                type: "area",
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: false,
            },
            colors: ["#0d6efd", "#20c997"],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "smooth",
            },
            xaxis: {
                type: "datetime",
                categories: [
                    "2023-01-01",
                    "2023-02-01",
                    "2023-03-01",
                    "2023-04-01",
                    "2023-05-01",
                    "2023-06-01",
                    "2023-07-01",
                ],
            },
            tooltip: {
                x: {
                    format: "MMMM yyyy",
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector("#revenue-chart"),
            sales_chart_options,
        );
        sales_chart.render();
    </script> <!-- jsvectormap -->
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js" integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js" integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script> <!-- jsvectormap -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myDataTable');
    </script>
    <script>
            $(document).ready(function() {
        let table = $('#myDataTable').DataTable();

        // Terapkan CSS ulang setelah filter digunakan
        table.on('draw', function() {
            // Terapkan ukuran font kembali setiap kali tabel di-refresh
            $('table th, table td').css('font-size', '18px');
            $('.btn-sm').css({
                'font-size': '16px',
                'padding': '8px 12px'
            });
        });
    });
    </script>




    <script>
        const visitorsData = {
            US: 398, // USA
            SA: 400, // Saudi Arabia
            CA: 1000, // Canada
            DE: 500, // Germany
            FR: 760, // France
            CN: 300, // China
            AU: 700, // Australia
            BR: 600, // Brazil
            IN: 800, // India
            GB: 320, // Great Britain
            RU: 3000, // Russia
        };

        // World map by jsVectorMap
        const map = new jsVectorMap({
            selector: "#world-map",
            map: "world",
        });

        // Sparkline charts
        const option_sparkline1 = {
            series: [{
                data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
            }, ],
            chart: {
                type: "area",
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: "straight",
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ["#DCE6EC"],
        };

        const sparkline1 = new ApexCharts(
            document.querySelector("#sparkline-1"),
            option_sparkline1,
        );
        sparkline1.render();

        const option_sparkline2 = {
            series: [{
                data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
            }, ],
            chart: {
                type: "area",
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: "straight",
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ["#DCE6EC"],
        };

        const sparkline2 = new ApexCharts(
            document.querySelector("#sparkline-2"),
            option_sparkline2,
        );
        sparkline2.render();

        const option_sparkline3 = {
            series: [{
                data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
            }, ],
            chart: {
                type: "area",
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: "straight",
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ["#DCE6EC"],
        };

        const sparkline3 = new ApexCharts(
            document.querySelector("#sparkline-3"),
            option_sparkline3,
        );
        sparkline3.render();


    </script> <!--end::Script-->
</body><!--end::Body-->

</html>
