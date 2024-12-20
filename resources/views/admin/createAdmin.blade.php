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
                            <a href="{{ route('createAdmin') }}" class="nav-link active">
                                <i class="bi bi-person-plus nav-icon"></i> Create Admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('historyAdmin') }}" class="nav-link">
                                <i class="bi bi-clock-history nav-icon"></i> History
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- End: Sidebar -->


        <main class="app-main">
            <div class="app-content-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                        </div>



                    <!-- Modal for creating admin -->
                    <div class="modal fade" id="createAdminModal" tabindex="-1" aria-labelledby="createAdminLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="createAdminLabel">Create Admin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="{{ route('admin.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                <label for="nama_admin" class="form-label">Nama Admin</label>
                                <input type="text" class="form-control" id="nama_admin" name="nama_admin" required>
                                </div>
                                <div class="mb-3">
                                <label for="username_admin" class="form-label">Username Admin</label>
                                <input type="text" class="form-control" id="username_admin" name="username_admin" required>
                                </div>
                                <div class="mb-3">
                                <label for="password_admin" class="form-label">Password Admin</label>
                                <input type="password" class="form-control" id="password_admin" name="password_admin" required>
                                </div>
                                <div class="mb-3">
                                <label for="id_role" class="form-label">Role</label>
                                <select class="form-select" id="id_role" name="id_role" required>
                                    <option value="1">Super Admin</option>
                                    <option value="2">Admin</option>
                                </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Admin</button>
                            </div>
                            </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="container">
                <h2>Daftar Admin</h2>
                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAdminModal">
                        Create Admin
                    </button>
                </div>

                <table id="dataTablesAdmin" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Admin</th>
                            <th>Nama Admin</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataAdmin as $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $admin->id_admin }}</td>
                            <td>{{ $admin->nama_admin }}</td>
                            <td>{{ $admin->username_admin }}</td>
                            <td>{{ $admin->role->nama_role }}</td>
                            <td>
                                @if(Auth::guard('admin')->user()->id_admin == 1)
                                    <button
                                        type="button"
                                        class="btn btn-primary btn-edit-admin"
                                        data-id="{{ $admin->id_admin }}"
                                        data-nama="{{ $admin->nama_admin }}"
                                        data-username="{{ $admin->username_admin }}"
                                        data-password="{{ $admin->password_admin }}"
                                        data-role="{{ $admin->id_role }}">
                                        Edit
                                    </button>
                                @elseif(Auth::guard('admin')->user()->id_admin != 1 && $admin->id_admin != 1)
                                    <!-- Super Admin lainnya dapat mengedit admin lain kecuali Super Admin ID 1 -->
                                    <button
                                        type="button"
                                        class="btn btn-primary btn-edit-admin"
                                        data-id="{{ $admin->id_admin }}"
                                        data-nama="{{ $admin->nama_admin }}"
                                        data-username="{{ $admin->username_admin }}"
                                        data-password="{{ $admin->password_admin }}"
                                        data-role="{{ $admin->id_role }}">
                                        Edit
                                    </button>
                                @endif

                                <!-- Tombol delete, hanya muncul jika bukan Super Admin ID 1 -->
                                @if($admin->id_admin != 1)
                                <form action="{{ route('admin.destroy', $admin->id_admin) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus admin ini?')">Delete</button>
                                </form>
                                @endif
                            </td>


                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editAdminLabel">Edit Admin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editAdminForm" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="edit_nama_admin" class="form-label">Nama Admin</label>
                                    <input type="text" class="form-control" id="edit_nama_admin" name="nama_admin" required>
                                </div>

                                <div class="mb-3">
                                    <label for="edit_username_admin" class="form-label">Username Admin</label>
                                    <input type="text" class="form-control" id="edit_username_admin" name="username_admin" required>
                                </div>

                                <div class="mb-3">
                                    <label for="edit_password_admin" class="form-label">Password Admin (Kosongkan jika tidak diubah)</label>
                                    <input type="password" class="form-control" id="edit_password_admin" name="password_admin" placeholder="Biarkan kosong jika tidak ingin mengubah">
                                </div>

                                <div class="mb-3">
                                    <label for="edit_id_role" class="form-label">Role</label>
                                    <select class="form-select" id="edit_id_role" name="id_role" required>
                                        <option value="1">Super Admin</option>
                                        <option value="2">Admin</option>
                                    </select>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="editAdminForm">Update Admin</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script>
    <script src="../../../dist/js/adminlte.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#dataTablesAdmin');

    </script>
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
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const editButtons = document.querySelectorAll(".btn-edit-admin");

            editButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const id = this.getAttribute("data-id");
                    const nama = this.getAttribute("data-nama");
                    const username = this.getAttribute("data-username");
                    const role = this.getAttribute("data-role");


                    document.getElementById("edit_nama_admin").value = nama;
                    document.getElementById("edit_username_admin").value = username;
                    document.getElementById("edit_id_role").value = role;

                    document.getElementById("edit_password_admin").value = "";

                    const form = document.getElementById("editAdminForm");
                    form.action = `/admin/${id}`;

                    const editModal = new bootstrap.Modal(document.getElementById("editAdminModal"));
                    editModal.show();
                });
            });
        });
    </script>
    <script>
        document.getElementById('confirmLogout').addEventListener('click', function() {
            document.getElementById('logout-form').submit();
        });
    </script>

</body>
</html>
