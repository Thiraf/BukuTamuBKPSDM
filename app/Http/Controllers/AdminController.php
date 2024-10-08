<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Admin; // Pastikan model Admin sudah ada dan disesuaikan
use Illuminate\Support\Facades\Hash; // Untuk verifikasi password
use Illuminate\Support\Facades\Session; // Untuk session
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\DashboardAdmin;
use App\Models\Status;
use Illuminate\Http\RedirectResponse;

use App\Models\Role;


class AdminController extends Controller
{
    public function showLoginForm()
    {
        Log::info("Cek Login");
        return view('admin.login'); // Sesuaikan dengan lokasi view Anda
    }

    public function login(Request $request): RedirectResponse
    {
        Log::info('Proses autentikasi dimulai');
        // Validasi input
        $credentials = $request->validate([
            'username_admin' => 'required|string',
            'password' => 'required|string|min:8',
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
            // Jika cocok, simpan informasi admin ke dalam session
            session(['admin' => $admin]);

            // Debug untuk memastikan login berhasil
            Log::info('Login berhasil', ['id' => $admin->id_admin]);

            Log::info('Login successful:', ['username' => $credentials['username_admin']]);

            // Redirect ke halaman dashboard
            return to_route('showdashboard')->with('success','');
        } else {
            // Debug untuk login gagal
            Log::warning('Login gagal: Username atau password salah');

            Log::warning('Login failed:', ['username' => $credentials['username_admin']]);

            // Jika tidak cocok, kembalikan ke halaman login dengan pesan error
            return to_route('login')->with('error', 'Username atau password salah.');
        }
    }


    public function showDashboard()
    {

        // dd(Auth::user());
        Log::info("Show Dashboard");

        // Mengambil semua data dari tabel dashboard_admins
        $dataDashboard = DashboardAdmin::with(['bidang', 'layanan', 'status'])->get();

        $statuses = Status::all(); // Ambil semua status untuk dropdown

        $pendingCount = DashboardAdmin::where('id_status', 1)->count(); // Misalkan 1 = Pending
        $processCount = DashboardAdmin::where('id_status', 2)->count(); // Misalkan 2 = Process
        $completedCount = DashboardAdmin::where('id_status', 3)->count(); // Misalkan 3 = Selesai


        // Mengirim data ke view
        return view('admin.dashboard', compact('dataDashboard','statuses','pendingCount','processCount','completedCount'));
    }

    public function updateStatus(Request $request, $id_dashboard_admin)
    {
        Log::info("Update Status");
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


    public function createAdmin()
    {
        // dd(Auth::user());

        // Ambil user yang sedang login
        $admin = Auth::guard('admin')->user();

        // Cek apakah user memiliki role Super Admin (misal id_role = 1 untuk Super Admin)
        if ($admin->id_role != 1) {
            // Redirect jika bukan super admin
            return redirect()->route('dashboard')->with('error', 'Akses ditolak. Hanya Super Admin yang bisa mengakses halaman ini.');
        }

        // Jika pengguna adalah Super Admin, tampilkan halaman Create Admin
        $dataAdmin= Admin::all();
        $dataAdmin = Admin::with('role')->get();
        return view('admin.createAdmin', compact('dataAdmin'));
    }

    // public function store(Request $request)
    // {


    //     Log::info("store");
    //     // Validasi input
    //     $request->validate([
    //         'nama_admin' => 'required|string|max:255',
    //         'username_admin' => 'required|string|max:100|unique:admins,username_admin',
    //         'password_admin' => 'required|string|max:255',
    //         'id_role' => 'required|integer',
    //     ]);

    //     // Insert data ke tabel admins
    //     $dataAdmin = DB::table('admins')->insertGetId([
    //         'nama_admin' => $request->nama_admin,
    //         'username_admin' => $request->username_admin,
    //         'password_admin' => $request->password_admin, // Hash password
    //         'id_role' => $request->id_role,
    //         'createAdd' => now(),
    //         'updateAdd' => now(),
    //         'userAdd' => 1, // Default value atau bisa diubah jika sesuai dengan user
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);


    //     Log::info("test");

    //     if ($dataAdmin) {
    //         return redirect()->route('createAdmin', ['id' => $dataAdmin])
    //             ->with('success', 'Admin account created successfully.');
    //     } else {
    //         return redirect()->route('admin.create')->with('error', 'Failed to create admin account.');
    //     }

    // }


    public function store(Request $request)
    {
        Log::info("store");

        // Validasi input
        $request->validate([
            'nama_admin' => 'required|string|max:255',
            'username_admin' => 'required|string|max:100|unique:admins,username_admin',
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

        Log::info("test");

        if ($dataAdmin) {return redirect()->route('createAdmin', ['id' => $dataAdmin])
                ->with('success', 'Admin account created successfully.');
        } else {
            return redirect()->route('admin.create')->with('error', 'Failed to create admin account.');
        }
    }


    // Mengupdate data admin
    public function update(Request $request, $id) {
        Log::info("Update Request");

        // Temukan admin berdasarkan ID
        $admin = Admin::findOrFail($id);

        // Update nama dan username
        $admin->nama_admin = $request->input('nama_admin');
        $admin->username_admin = $request->input('username_admin');

        // Cek apakah password diisi dan apakah bertipe string
        if ($request->filled('password_admin') && is_string($request->input('password_admin'))) {
            // Simpan password baru dengan enkripsi
            $admin->password_admin = Hash::make($request->input(key: 'password_admin'));
        }

        // Update id_role
        $admin->id_role = $request->input('id_role');

        // Simpan perubahan
        $admin->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('createAdmin')->with('success', 'Admin berhasil diperbarui');
    }



    public function destroy($id)
    {
        Log::info("Menghapus");
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



