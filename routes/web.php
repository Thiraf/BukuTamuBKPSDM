<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckSuperAdmin;
use App\Http\Middleware\CheckNIK;

use Mews\Captcha\Captcha;







// Client Buku Tamu

// Route untuk verifikasi NIK
Route::post('/buku-tamu/cek-nik', [BukuTamuController::class, 'cekNik']);


// Gunakan middleware CheckNIK untuk semua route di group ini
Route::middleware([CheckNIK::class])->group(function () {

    // Route untuk halaman data pekerja jika NIK ditemukan
    Route::get('/data-pekerja', [BukuTamuController::class, 'showDataPekerja'])
        ->name('buku_tamu.data_pekerja');

    // Route untuk halaman form pekerja baru jika NIK tidak ditemukan
    Route::get('/form-pekerja-baru', [BukuTamuController::class, 'formPekerjaBaru'])
        ->name('buku_tamu.form_pekerja_baru');

    // Route untuk menyimpan data pegawai dari form buku tamu
    Route::post('/buku-tamu/simpan-pegawai', [BukuTamuController::class, 'simpanPegawai'])
        ->name('buku_tamu.simpan_pegawai');

    // Mengarahkan ke halaman tujuan Informasi
    Route::get('/tujuan-informasi/{id}', [BukuTamuController::class, 'tujuanInformasi'])
        ->name('tujuan_informasi');
});


Route::post('/buku-tamu/update-pegawai', [BukuTamuController::class, 'updatePegawai'])->name('update_pegawai');

// Route untuk update
Route::put('/buku-tamu/{id_buku_tamu}/update', [BukuTamuController::class, 'update'])->name('buku-tamu.update');








// Admin Login
Route::get('/login', function () {
    return view('admin/login');
})->name('login');

Route::get('captcha/{config?}', function(Captcha $captcha, $config = 'default') {
    return $captcha->create($config);
});

// Route untuk menampilkan halaman dashboard setelah login berhasil
Route::get('/dashboard', function () {
    return view('/dashboard');
})->name('dashboard');

//Mensubmit login admin
Route::post('admin/login', [AdminController::class, 'login'])
    ->withoutMiddleware(CheckSuperAdmin::class)
    ->name('admin.login.submit');

// Menampilkan dashboard admin
Route::get('admin/dashboard', [AdminController::class, 'showDashboard'])
    ->withoutMiddleware(CheckSuperAdmin::class)
    ->name('admin.dashboard');


// Route untuk logout
Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');




// Function Fitur Create Admin

// Route untuk memanggil method addToDashboard
Route::post('/dashboard-admins/add/{id_buku_tamu}', [AdminController::class, 'addToDashboard'])->name('dashboard-admins.add');

// Filter data
Route::get('/dashboard/filter', [AdminController::class, 'filterData'])->name('dashboard.filter');

// web.php
Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('showdashboard');

// Update Statuses
Route::put('/update-status/{id_dashboard_admin}', [AdminController::class, 'updateStatus'])->name('updateStatus');

// Logout Admin
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

// Menampilkan Create Admin
Route::get('createAdmin', [AdminController::class, 'createAdmin'])
    ->middleware(CheckSuperAdmin::class)
    ->name('createAdmin');

Route::post('/storeAdmin', [AdminController::class, 'store'])->name('admin.store');







// Dashboard Create Admin

// Edit Admin
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');

// Update Admin
Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');

Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');

// Hapus Admin
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');











