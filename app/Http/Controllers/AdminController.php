<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash; // Untuk verifikasi password
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\DashboardAdmin;
use App\Models\BukuTamu;
use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Mews\Captcha\Captcha;

class AdminController extends Controller
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

        // dd($request->all());

        Log::info('Request data:', $request->all());

        // Cek apakah username dan password cocok
        $admin = Admin::where('username_admin', $credentials['username_admin'])->first();

        Log::debug('Cek credentials', ['credentials' => $credentials]);


        // Debug untuk cek apakah admin ditemukan di database
        Log::info('Admin data', ['admin' => $admin]);

        // Cek autentikasi admin
        if (Auth::guard('admin')->attempt(['username_admin' => $request->username_admin, 'password' => $request->password])) {

            session(['admin' => $admin]);


            return to_route('showdashboard')->with('success', 'Login berhasil!');
        } else {


            Log::warning('Login failed:', ['username' => $credentials['username_admin']]);
            Log::warning('Login failed:', ['password' => $credentials['password']]);


            // Jika tidak cocok, kembalikan ke halaman login dengan pesan error
            return to_route('login')->with('error', 'Username atau password salah.');
        }
    }


    public function showDashboard()
    {

        // dd(Auth::user());
        Log::info("Show Dashboard");

        // Query data tamu
        $dataDashboard = BukuTamu::all();

        // Query data status
        $statuses = Status::all(); // Pastikan ini sesuai dengan model dan tabel status Anda

        // Mengambil semua data dari tabel dashboard_admins
        $dataDashboard = DashboardAdmin::with(['bidang', 'layanan', 'status'])->get();

        $statuses = Status::all(); // Ambil semua status untuk dropdown

        $pendingCount = DashboardAdmin::where('id_status', 1)->count(); // Misalkan 1 = Pending
        $processCount = DashboardAdmin::where('id_status', 2)->count(); // Misalkan 2 = Process
        $completedCount = DashboardAdmin::where('id_status', 3)->count(); // Misalkan 3 = Selesai

        // Hitung jumlah total semua data
        $totalCount = $pendingCount + $processCount + $completedCount;

        // Mengirim data ke view
        return view('admin.dashboard', compact('dataDashboard', 'statuses', 'pendingCount', 'processCount', 'completedCount', 'totalCount'));
    }

    public function updateStatus(Request $request, $id_dashboard_admin)
    {
        Log::info("Update Status");
        Log::info('ID Dashboard Admin: ' . $id_dashboard_admin);
        // Validasi input id_status
        $request->validate([
            'id_status' => 'required|exists:statuses,id_status',
        ]);

        // Temukan data dashboard_admin berdasarkan ID
        $dashboardAdmin = DashboardAdmin::findOrFail($id_dashboard_admin);

        Log::info("Id ditemukan");
        // Update status dengan id_status baru
        $dashboardAdmin->id_status = $request->input('id_status');

        $dashboardAdmin->save();

        // Redirect kembali ke halaman dashboard dengan pesan sukses
        return redirect()->back();
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
            // Mengonversi input datetime-local menjadi format 'Y-m-d H:i:s'
            $startDate = \Carbon\Carbon::parse($startDate)->format('Y-m-d H:i:s');
        }

        if ($endDate) {
            // Mengonversi input datetime-local menjadi format 'Y-m-d H:i:s'
            $endDate = \Carbon\Carbon::parse($endDate)->format('Y-m-d H:i:s');
        }

        // Query data DashboardAdmin
        $dataDashboard = DashboardAdmin::with(['bidang', 'layanan', 'status', 'bukuTamu']);


        // Tambahkan kondisi untuk tanggal hanya jika diisi
        if ($startDate && $endDate) {
            $dataDashboard->whereHas('bukuTamu', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            });
        }

        // dd($dataDashboard);


        if ($statusFilter) {
            $dataDashboard->where('id_status', $statusFilter);
        }

        $dataDashboard = $dataDashboard->get(); // Eksekusi query

        // Log setiap item dalam data yang ter-filter
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

        // Hitung status (Pending, Process, Completed)
        $pendingCount = DashboardAdmin::where('id_status', 1)->count(); // Misalkan 1 = Pending
        $processCount = DashboardAdmin::where('id_status', 2)->count(); // Misalkan 2 = Process
        $completedCount = DashboardAdmin::where('id_status', 3)->count(); // Misalkan 3 = Selesai
        $totalCount = $pendingCount + $processCount + $completedCount;

        // Fetch all statuses
        $statuses = Status::all(); // Ambil semua status untuk dropdown

        Log::debug('Filter Data:', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'statusFilter' => $statusFilter
        ]);


        // Kembalikan view dengan data yang sudah difilter, statuses, dan status counts
        return view('admin.dashboard', compact('dataDashboard', 'statuses', 'pendingCount', 'processCount', 'completedCount', 'totalCount'));
    }


    public function createAdmin()
    {
        // dd(Auth::user());

        // Ambil user yang sedang login
        $admin = Auth::guard('admin')->user();
        // dd($admin);

        // Cek apakah user memiliki role Super Admin (misal id_role = 1 untuk Super Admin)
        if ($admin->id_role != 1) {
            // Redirect jika bukan super admin
            return redirect()->route('dashboard')->with('error', 'Akses ditolak. Hanya Super Admin yang bisa mengakses halaman ini.');
        }

        // Jika pengguna adalah Super Admin, tampilkan halaman Create Admin
        $dataAdmin = Admin::all();
        $dataAdmin = Admin::with('role')->get();
        return view('admin.createAdmin', compact('dataAdmin'));
    }


    public function store(Request $request)
    {
        Log::info("store");

        // Validasi input
        $request->validate([
            'nama_admin' => 'required|string|max:255',
            'username_admin' => 'required|string|max:255',
            'password_admin' => 'required|string|max:255',
            'id_role' => 'required|integer',
        ]);

        // Hash password sebelum disimpan
        $hashedPassword = Hash::make($request->password_admin);

        // Insert data ke tabel admins
        $dataAdmin = DB::table('admins')->insertGetId([
            'nama_admin' => $request->nama_admin,
            'username_admin' => $request->username_admin,
            'password_admin' => $hashedPassword, // Simpan hashed password
            'id_role' => $request->id_role,
            'createAdd' => now(),
            'updateAdd' => now(),
            'userAdd' => 1, // Default value atau bisa diubah jika sesuai dengan user
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Log::info('Admin Data:', $request->all());

        // Log perubahan data termasuk password
        Log::info("Admin created", [
            'id' => $dataAdmin,
            'nama_admin' => $request->nama_admin,
            'username_admin' => $request->username_admin,
            'password_admin' => $request->password_admin, // Logging password
            'id_role' => $request->id_role,
        ]);

        Log::info("test");

        // if ($dataAdmin) {return redirect()->route('createAdmin', ['id' => $dataAdmin])
        //         ->with('success', 'Admin account created successfully.');
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

        // Validasi input
        $request->validate([
            'nama_admin' => 'required|string|max:255',
            'username_admin' => 'required|string|max:255',
            'password_admin' => 'nullable|string|max:255', // Password bisa kosong jika tidak diubah
            'id_role' => 'required|integer',
        ]);

        // Ambil data admin berdasarkan ID
        $admin = DB::table('admins')->where('id_admin', $id)->first();

        if (!$admin) {
            Log::warning('Admin not found', ['id' => $id]);
            return redirect()->route('createAdmin')->with('error', 'Admin not found.');
        }

        // Siapkan data untuk diupdate (tanpa password terlebih dahulu)
        $updateData = [
            'nama_admin' => $request->nama_admin,
            'username_admin' => $request->username_admin,
            'id_role' => $request->id_role,
            'updateAdd' => now(),
            'updated_at' => now(),
        ];

        // Cek jika password ingin diubah (tidak kosong)
        if (!empty($request->password_admin)) {
            // Hash password sebelum menyimpan
            $hashedPassword = Hash::make($request->password_admin);
            $updateData['password_admin'] = $hashedPassword; // Hanya update jika password diisi
        }

        // Update data admin di database
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

        // Cek apakah ID yang ingin dihapus adalah 1 (Super Admin utama)
        if ($id == 1) {
            return redirect()->route('createAdmin')->with('error', 'Super Admin utama tidak dapat dihapus.');
        }

        // Hapus admin berdasarkan ID
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('createAdmin')->with('success', 'Admin account deleted successfully.');
    }


    public function logout(Request $request)
    {
        Auth::logout(); // Untuk mengakhiri sesi pengguna yang sedang login

        $request->session()->invalidate(); // Mengosongkan sesi saat ini
        $request->session()->regenerateToken(); // Regenerasi token untuk keamanan

        return redirect('/login'); // Arahkan kembali ke halaman login
    }
}
