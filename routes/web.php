<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckSuperAdmin;
use App\Http\Middleware\CheckNIP;
use Mews\Captcha\Captcha;
use App\Exports\DashboardAdminExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('index');
})->name('index');

// Client Buku Tamu
Route::post('/buku-tamu/cek-nip', [BukuTamuController::class, 'cekNip']);
Route::get('/data-pekerja', [BukuTamuController::class, 'showDataPekerja'])->name('buku_tamu.data_pekerja');
Route::get('/form-pekerja-baru', [BukuTamuController::class, 'formPekerjaBaru'])->name('buku_tamu.form_pekerja_baru');
Route::post('/buku-tamu/simpan-pegawai', [BukuTamuController::class, 'simpanPegawai'])->name('buku_tamu.simpan_pegawai');
Route::get('/tujuan-informasi/{id}', [BukuTamuController::class, 'tujuanInformasi'])->name('tujuan_informasi');
Route::post('/buku-tamu/update-pegawai', [BukuTamuController::class, 'updatePegawai'])->name('update_pegawai');
Route::put('/buku-tamu/{id_buku_tamu}/update', [BukuTamuController::class, 'update'])->name('buku-tamu.update');


// Admin Login
Route::get('/login', function () {
    return view('admin/login');
})->name('login');

Route::get('captcha/{config?}', function(Captcha $captcha, $config = 'default') {
    return $captcha->create($config);
});

Route::get('/dashboard', function () {
    return view('/dashboard');
})->name('dashboard');

Route::post('admin/login', [AdminController::class, 'login'])
    ->withoutMiddleware(CheckSuperAdmin::class)
    ->name('admin.login.submit');

Route::get('admin/dashboard', [AdminController::class, 'showDashboard'])
    ->withoutMiddleware(CheckSuperAdmin::class)
    ->name('admin.dashboard');

Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin Features
Route::post('/dashboard-admins/add/{id_buku_tamu}', [AdminController::class, 'addToDashboard'])->name('dashboard-admins.add');
Route::get('/dashboard/filter', [AdminController::class, 'filterData'])->name('dashboard.filter');
Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('showdashboard');
Route::put('/update-status/{id_dashboard_admin}', [AdminController::class, 'updateStatus'])->name('updateStatus');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

Route::get('createAdmin', [AdminController::class, 'createAdmin'])
    ->middleware(CheckSuperAdmin::class)
    ->name('createAdmin');

Route::get('historyAdmin', [AdminController::class, 'showHistory'])->name('historyAdmin');
Route::post('/storeAdmin', [AdminController::class, 'store'])->name('admin.store');

// Edit Admin
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');

// Update Admin
Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');

Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');

// Hapus Admin
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');


// // Export Excel
// Route::get('/export-dashboard-admin', function () {
//     return Excel::download(new DashboardAdminExport, 'dashboard_admin.xlsx');
// });


Route::get('/export-dashboard-admin', [AdminController::class, 'exportDashboardAdmin'])->name('export.dashboard.admin');





