<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\DashboardAdmin;
use App\Models\BukuTamu;
use App\Models\Status;
use App\Models\StatusHistory;
use Illuminate\Http\RedirectResponse;
use Mews\Captcha\Captcha;

class AdminController
{

    public function showLoginForm()
    {
        Log::info("Cek Login");
        return view('admin.login');
    }

    public function generateCaptcha(Captcha $captcha)
    {
        Log::info('Captcha');
        return $captcha->create();
    }

    public function login(Request $request): RedirectResponse
    {
        Log::info('Proses autentikasi dimulai');

        $credentials = $request->validate([
            'username_admin' => 'required|string|max:255',
            'password' => 'required|string|max:10',
            'captcha' => 'required|captcha',
        ], [
            'captcha.captcha' => 'Captcha salah, silahkan coba lagi.',
        ]);

        Log::info('Request data:', $request->all());

        $admin = Admin::where('username_admin', $credentials['username_admin'])->first();

        Log::debug('Cek credentials', ['credentials' => $credentials]);

        Log::info('Admin data', ['admin' => $admin]);


        if (Auth::guard('admin')->attempt(['username_admin' => $request->username_admin, 'password' => $request->password])) {

            session(['admin' => $admin]);


            return to_route('showdashboard')->with('success', 'Login berhasil!');
        } else {


            Log::warning('Login failed:', ['username' => $credentials['username_admin']]);
            Log::warning('Login failed:', ['password' => $credentials['password']]);

            return to_route('login')->with('error', 'Username atau password salah.');
        }
    }


    public function showDashboard()
    {


        Log::info("Show Dashboard");


        $dataDashboard = BukuTamu::all();


        $statuses = Status::all();


        $dataDashboard = DashboardAdmin::with(['bidang', 'layanan', 'status'])->get();

        $statuses = Status::all();

        $pendingCount = DashboardAdmin::where('id_status', 1)->count();
        $processCount = DashboardAdmin::where('id_status', 2)->count();
        $completedCount = DashboardAdmin::where('id_status', 3)->count();


        $totalCount = $pendingCount + $processCount + $completedCount;

        return view('admin.dashboard', compact('dataDashboard', 'statuses', 'pendingCount', 'processCount', 'completedCount', 'totalCount'));
    }


    public function showHistory()
    {
        $historyData = StatusHistory::with('dashboardAdmin')->get();
        return view('admin.historyAdmin', compact('historyData'));
    }

    public function updateStatus(Request $request, $id_buku_tamu)
    {
        $request->validate([
            'id_status' => 'required|exists:statuses,id_status',
        ]);

        $dashboardAdmin = DashboardAdmin::findOrFail($id_buku_tamu);

        $oldStatus = $dashboardAdmin->status->status_name ?? 'N/A';

        Log::info('Cek Data Sebelum Update', [
            'ID Buku Tamu' => $dashboardAdmin->id_buku_tamu,
            'Old Status' => $oldStatus,
            'Request ID Status' => $request->input('id_status'),
        ]);

        $dashboardAdmin->id_status = $request->input('id_status');
        $dashboardAdmin->save();

        $dashboardAdmin->refresh();

        // Simpan log perubahan ke status_histories
        StatusHistory::create([
            'id_dashboard_admin' => $dashboardAdmin->id_buku_tamu,
            'username_admin' => Auth::guard('admin')->user()->username_admin,
            'old_status' => $oldStatus,
            'new_status' => $dashboardAdmin->status->status_name,
            'updated_at' => now(),
        ]);

        Log::info('Cek Data Setelah Update', [
            'ID Buku Tamu' => $dashboardAdmin->id_buku_tamu,
            'New Status' => $dashboardAdmin->status->status_name,
        ]);

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }



    public function filterData(Request $request)
    {
        Log::info("Filter Data");

        $request->validate([
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date|after_or_equal:startDate',
        ]);

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $statusFilter = $request->input('statusFilter');


        if ($startDate) {
            $startDate = \Carbon\Carbon::parse($startDate)->format('Y-m-d H:i:s');
        }

        if ($endDate) {
            $endDate = \Carbon\Carbon::parse($endDate)->format('Y-m-d H:i:s');
        }

        $dataDashboard = DashboardAdmin::with(['bidang', 'layanan', 'status', 'bukuTamu']);

        if ($startDate && $endDate) {
            $dataDashboard->whereHas('bukuTamu', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            });
        }

        if ($statusFilter) {
            $dataDashboard->where('id_status', $statusFilter);
        }

        $dataDashboard = $dataDashboard->get();

        foreach ($dataDashboard as $dataTamu) {
            Log::info('Data Tamu:', [
                'id_dashboard_admin' => $dataTamu->id_dashboard_admin,
                'nip' => $dataTamu->nip,
                'nama_pegawai' => $dataTamu->nama_pegawai,
                'jabatan_pegawai' => $dataTamu->jabatan_pegawai,
                'unit_kerja_pegawai' => $dataTamu->unit_kerja_pegawai,
                'tujuan_informasi' => $dataTamu->tujuan_informasi,
                'bidang' => $dataTamu->bidang->nama_bidang,
                'layanan' => $dataTamu->layanan->nama_layanan,
                'created_at' => $dataTamu->created_at->timezone('Asia/Jakarta')->format('d-m-Y, H:i:s'),
                'updated_at' => $dataTamu->updated_at->timezone('Asia/Jakarta')->format('d-m-Y, H:i:s'),
            ]);
        }

        $pendingCount = DashboardAdmin::where('id_status', 1)->count();
        $processCount = DashboardAdmin::where('id_status', 2)->count();
        $completedCount = DashboardAdmin::where('id_status', 3)->count();
        $totalCount = $pendingCount + $processCount + $completedCount;

        $statuses = Status::all();

        Log::debug('Filter Data:', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'statusFilter' => $statusFilter
        ]);

        return view('admin.dashboard', compact('dataDashboard', 'statuses', 'pendingCount', 'processCount', 'completedCount', 'totalCount'));
    }


    public function createAdmin()
    {
        $admin = Auth::guard('admin')->user();

        if ($admin->id_role != 1) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak. Hanya Super Admin yang bisa mengakses halaman ini.');
        }

        $dataAdmin = Admin::all();
        $dataAdmin = Admin::with('role')->get();
        return view('admin.createAdmin', compact('dataAdmin'));
    }

    public function store(Request $request)
    {
        Log::info("store");

        $request->validate([
            'nama_admin' => 'required|string|max:255',
            'username_admin' => 'required|string|max:255',
            'password_admin' => 'required|string|max:255',
            'id_role' => 'required|integer',
        ]);


        $hashedPassword = Hash::make($request->password_admin);


        $dataAdmin = DB::table('admins')->insertGetId([
            'nama_admin' => $request->nama_admin,
            'username_admin' => $request->username_admin,
            'password_admin' => $hashedPassword,
            'id_role' => $request->id_role,
            'createAdd' => now(),
            'updateAdd' => now(),
            'userAdd' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Log::info('Admin Data:', $request->all());

        Log::info("Admin created", [
            'id' => $dataAdmin,
            'nama_admin' => $request->nama_admin,
            'username_admin' => $request->username_admin,
            'password_admin' => $request->password_admin,
            'id_role' => $request->id_role,
        ]);

        Log::info("test");

        if ($dataAdmin) {
            return redirect()->route('createAdmin')
                ->with('success', 'Admin account created successfully.');
        } else {
            return redirect()->route('admin.create')->with('error', 'Failed to create admin account.');
        }
    }

    public function update(Request $request, $id)
    {
        Log::info("Update Request");

        $request->validate([
            'nama_admin' => 'required|string|max:255',
            'username_admin' => 'required|string|max:255',
            'password_admin' => 'nullable|string|max:255',
            'id_role' => 'required|integer',
        ]);

        $admin = DB::table('admins')->where('id_admin', $id)->first();

        if (!$admin) {
            Log::warning('Admin not found', ['id' => $id]);
            return redirect()->route('createAdmin')->with('error', 'Admin not found.');
        }

        $updateData = [
            'nama_admin' => $request->nama_admin,
            'username_admin' => $request->username_admin,
            'id_role' => $request->id_role,
            'updateAdd' => now(),
            'updated_at' => now(),
        ];

        if (!empty($request->password_admin)) {

            $hashedPassword = Hash::make($request->password_admin);
            $updateData['password_admin'] = $hashedPassword;
        }

        $isUpdated = DB::table('admins')->where('id_admin', $id)->update($updateData);

        if ($isUpdated) {
            Log::info('Admin updated', [
                'id' => $id,
                'new_data' => $updateData,
            ]);

            return redirect()->route('createAdmin')->with('success', 'Admin updated successfully.');
        } else {
            Log::warning('Failed to update admin', ['id' => $id]);

            return redirect()->route('createAdmin')->with('error', 'Failed to update admin.');
        }
    }


    public function destroy($id)
    {
        Log::info("Menghapus");

        if ($id == 1) {
            return redirect()->route('createAdmin')->with('error', 'Super Admin utama tidak dapat dihapus.');
        }

        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('createAdmin')->with('success', 'Admin account deleted successfully.');
    }




    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
