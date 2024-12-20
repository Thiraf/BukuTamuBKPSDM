@php
    use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Buku Tamu BKPSDM Dashboard - Create Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE 4 | Layout Custom Area">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{asset('AdminLTE')}}/dist/css/adminlte.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/createAdmin.css') }}">
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav ms-auto">

                    <!-- User Menu Dropdown -->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{asset('AdminLTE')}}/dist/assets/img/logoProfile.jpg" class="user-image rounded-circle shadow" alt="User Image">
                            <span class="d-none d-md-inline">{{ Auth::guard('admin')->user()->username_admin }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
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
                            <div class="modal-content" style="background-color: rgb(247, 243, 243);">
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

                </ul>
            </div>
        </nav>

        <aside class="app-sidebar bg-dark shadow">
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
                            <a href="./dashboard" class="nav-link">
                                <i class="bi bi-journal nav-icon"></i> Buku Tamu
                            </a>
                        </li>
                        @if(Auth::guard('admin')->user()->id_role == 1)
                        <li class="nav-item">
                            <a href="{{ route('createAdmin') }}" class="nav-link">
                                <i class="bi bi-person-plus nav-icon"></i> Create Admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('historyAdmin') }}" class="nav-link active">
                                <i class="bi bi-clock-history nav-icon"></i> History
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="container-fluid">
            <div class="row w-100 p-0">
                <h3 class="mb-10 pt-4 text-center">History</h3>

                <div class="table-responsive">
                    <table id="myDataTable" class="table table-striped table-bordered" style="width:100%;">
                        <thead >
                            <tr>
                                <th>No</th>
                                <th>ID Buku Tamu</th>
                                <th>Status Lama</th>
                                <th>Status Baru</th>
                                <th>Diubah Oleh</th>
                                <th>Tanggal Perubahan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historyData as $history)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $history->id_dashboard_admin}}</td>
                                <td>
                                    @php
                                        $oldStatus = trim(strtolower($history->old_status));
                                        $newStatus = trim(strtolower($history->new_status));
                                    @endphp

                                    {{-- Old Status --}}
                                    @if($oldStatus == 'process')
                                        <span class="badge bg-info text-white px-3 py-2 fs-6">{{ $history->old_status }}</span>
                                    @elseif($oldStatus == 'pending')
                                        <span class="badge bg-warning text-dark px-3 py-2 fs-6">{{ $history->old_status }}</span>
                                    @elseif($oldStatus == 'selesai')
                                        <span class="badge bg-success text-white px-3 py-2 fs-6">{{ $history->old_status }}</span>
                                    @else
                                        <span class="badge bg-secondary text-white px-3 py-2 fs-6">{{ $history->old_status }}</span>
                                    @endif
                                </td>

                                <td>
                                    {{-- New Status --}}
                                    @if($newStatus == 'process')
                                        <span class="badge bg-info text-white px-3 py-2 fs-6">{{ $history->new_status }}</span>
                                    @elseif($newStatus == 'pending')
                                        <span class="badge bg-warning text-dark px-3 py-2 fs-6">{{ $history->new_status }}</span>
                                    @elseif($newStatus == 'selesai')
                                        <span class="badge bg-success text-white px-3 py-2 fs-6">{{ $history->new_status }}</span>
                                    @else
                                        <span class="badge bg-secondary text-white px-3 py-2 fs-6">{{ $history->new_status }}</span>
                                    @endif
                                </td>
                                <td>{{ $history->username_admin }}</td>
                                <td>{{ $history->updated_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

        <!-- End: Sidebar -->
        <script>
            document.getElementById('confirmLogout').addEventListener('click', function() {
                document.getElementById('logout-form').submit();
            });
        </script>

<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script>
<script src="../../../dist/js/adminlte.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

</body>
</html>
