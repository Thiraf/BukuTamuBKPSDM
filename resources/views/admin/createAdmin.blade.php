<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Buku Tamu BKPSDM Dashboard - Create Admin</title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE 4 | Layout Custom Area">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{asset('AdminLTE')}}/dist/css/adminlte.css"><!--end::Required Plugin(AdminLTE)-->
</head> <!--end::Head--> <!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->
                    <li class="nav-item"> <a class="nav-link" data-widget="navbar-search" href="#" role="button"> <i class="bi bi-search"></i> </a> </li> <!--end::Navbar Search--> <!--begin::Messages Dropdown Menu-->

                    <li class="nav-item dropdown"> <a class="nav-link" data-bs-toggle="dropdown" href="#"> <i class="bi bi-bell-fill"></i> <span class="navbar-badge badge text-bg-warning">15</span> </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"> <i class="bi bi-envelope me-2"></i> 4 new messages
                                <span class="float-end text-secondary fs-7">3 mins</span> </a>
                            <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"> <i class="bi bi-people-fill me-2"></i> 8 friend requests
                                <span class="float-end text-secondary fs-7">12 hours</span> </a>
                            <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"> <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                                <span class="float-end text-secondary fs-7">2 days</span> </a>
                            <div class="dropdown-divider"></div> <a href="#" class="dropdown-item dropdown-footer">
                                See All Notifications
                            </a>
                        </div>
                    </li> <!--end::Notifications Dropdown Menu--> <!--begin::Fullscreen Toggle-->
                    <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a> </li> <!--end::Fullscreen Toggle--> <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> <img src="{{asset('AdminLTE')}}/dist/assets/img/user2-160x160.jpg" class="user-image rounded-circle shadow" alt="User Image"> <span class="d-none d-md-inline">Alexander Pierce</span> </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
                            <li class="user-header text-bg-primary"> <img src="{{asset('AdminLTE')}}/dist/assets/img/user2-160x160.jpg" class="rounded-circle shadow" alt="User Image">
                                <p>
                                    Alexander Pierce - Web Developer
                                    <small>Member since Nov. 2023</small>
                                </p>
                            </li> <!--end::User Image--> <!--begin::Menu Body-->

                            <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-default btn-flat float-end">Sign out</button>
                                </form>
                            </li>
                            <!-- Tombol Profile dan Logout -->

                    </li> <!--end::User Menu Dropdown-->
                </ul> <!--end::End Navbar Links-->
            </div> <!--end::Container-->
        </nav> <!--end::Header--> <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
            <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="./index.html" class="brand-link"> <!--begin::Brand Image--> <img src="form/images/bkpsdm.jpg"  class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-light">Buku Tamu BKPSDM</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2"> <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <li class="nav-item menu-open">
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./dashboard" class="nav-link">
                                        <i class="nav-icon bi bi-journal"></i>
                                        <p>Buku Tamu</p>
                                    </a>
                                </li>
                                @if(Auth::guard('admin')->user()->id_role == 1) <!-- Pengecekan untuk Super Admin -->
                                    <li class="nav-item">
                                        <a href="./createAdmin" class="nav-link active">
                                            <i class="nav-icon bi bi-person-plus"></i>
                                            <p>Create Admin</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
            </div> <!--end::Sidebar Wrapper-->
        </aside> <!--end::Sidebar--> <!--begin::App Main-->

        <main class="app-main"> <!--begin::App Content Top Area-->
            <div class="app-content-top-area"> <!--begin::Container-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                        </div>

                        <!-- Button to trigger modal -->
                        <div class="col-md-6 text-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAdminModal">
                                Create Admin
                            </button>
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
                </div> <!--end::Container-->
            </div> <!--end::App Content Header--> <!--begin::App Content-->


            <div class="container">
                <h2>Daftar Admin</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
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
                            <td>{{ $admin->id_admin }}</td>
                            <td>{{ $admin->nama_admin }}</td>
                            <td>{{ $admin->username_admin }}</td>
                            <td>{{ $admin->role->nama_role }}</td>
                            <td>
                                <!-- Button untuk Edit -->
                                {{-- <a href="{{ route('admin.edit', $admin->id_admin) }}" class="btn btn-primary">Edit</a> --}}

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

                                <!-- Form untuk Delete -->
                                <form action="{{ route('admin.destroy', $admin->id_admin) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus admin ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <!-- Modal for editing admin -->
            <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editAdminLabel">Edit Admin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editAdminForm" action="" method="POST">
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
                                    <label for="edit_password_admin" class="form-label">Password Admin</label>
                                    <input type="password" class="form-control" id="edit_password_admin" name="password_admin" required>
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
                        <form action="{{ route('admin.store') }}" method="POST">
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="editAdminForm">Update Admin</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </main> <!--end::App Main--> <!--begin::Footer-->
    </div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="../../../dist/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    {{-- Uji Coba --}}
    {{-- <script src="app/resources/js/editAdmin.js"></script> --}}
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
    </script> <!--end::OverlayScrollbars Configure--> <!--end::Script-->
    <!-- HTML Content -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var editButtons = document.querySelectorAll('.btn-edit-admin');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = button.getAttribute('data-id');
                    var nama = button.getAttribute('data-nama');
                    var username = button.getAttribute('data-username');
                    var password = button.getAttribute('data-password');
                    var role = button.getAttribute('data-role');

                    document.getElementById('edit_nama_admin').value = nama;
                    document.getElementById('edit_username_admin').value = username;
                    document.getElementById('edit_password_admin').value = password;
                    document.getElementById('edit_id_role').value = role;

                    var form = document.getElementById('editAdminForm');
                    form.action = '/admin/' + id;

                    var editModal = new bootstrap.Modal(document.getElementById('editAdminModal'));
                    editModal.show();
                });
            });
        });
    </script>
</body><!--end::Body-->

</html>
