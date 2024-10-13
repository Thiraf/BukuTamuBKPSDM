<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\BukuTamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Layanan;
use App\Models\DashboardAdmin;
use App\Models\Status;

class BukuTamuController extends Controller
{

    protected $adminController;

    public function __construct(AdminController $adminController)
    {
        $this->adminController = $adminController;
    }


    public function cekNIK(Request $request)
    {

        // Log informasi untuk request POST
        Log::info('Masuk ke Function Cek Nik');

        // Validasi input NIK

        $nik = $request->input('nik');


        // Cari data pegawai berdasarkan NIK
        $pegawai = Pegawai::where('nik', $nik)->first();

        // return view('buku_tamu.form_pekerja_baru',compact('nik'));

        if ($pegawai) {
            // Simpan data ke session jika ditemukan
            session(['nik' => $nik]);
            // dd($pegawai->toArray());

            // Jika data pegawai ditemukan, arahkan ke halaman data_pekerja
            return redirect()->route('buku_tamu.data_pekerja'); // Pastikan ada route untuk ini
        } else {
            // Jika data pegawai tidak ditemukan, arahkan ke halaman form_pekerja_baru dengan NIK
            return redirect()->route('buku_tamu.form_pekerja_baru')->with('nik', $nik); // Pastikan ada route untuk ini
        }
    }

    public function showDataPekerja(Request $request)
    {
        Log::info('Show Data Pekerja');
        $pegawai = session('pegawai');
        // dd($pegawai->toArray());

        return view('buku_tamu.data_pekerja', compact('pegawai'));
    }

    public function formPekerjaBaru(Request $request)
    {
        Log::info('Masuk ke Function Form Pekerja Baru');
        $nik = $request->session()->get('nik');
        return view('buku_tamu.form_pekerja_baru', compact('nik'));
    }

    public function simpanPegawai(Request $request)
    {
        Log::info('Masuk ke Function Simpan Pegawai');

        // Validasi data yang dikirimkan
        $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'jabatan_pegawai' => 'required|string|max:255',
            'unit_kerja_pegawai' => 'required|string|max:255',
        ]);
        Log::info('cek');

        // Ambil NIK dari session (disimpan sebelumnya pada cekNIK)
        $nik = session('nik');

        // Simpan data ke tabel buku_tamus
        $bukuTamuId = DB::table('buku_tamus')->insertGetId([
            'nik' => $nik,  // Simpan NIK di sini
            'nama_pegawai' => $request->nama_pegawai,
            'jabatan_pegawai' => $request->jabatan_pegawai,
            'unit_kerja_pegawai' => $request->unit_kerja_pegawai,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Berpindah ke halaman tujuan_informasi dengan ID data yang baru disimpan
        return redirect()->route('tujuan_informasi', ['id' => $bukuTamuId])
            ->with('success', 'Data pegawai berhasil disimpan.');
    }


    public function tujuanInformasi($id)
    {

        Log::info('Simpan Pegawai Berhasil dilakukan');
        // Ambil data buku tamu berdasarkan ID
        $bukuTamu = DB::table('buku_tamus')->where('id_buku_tamu', $id)->first();
        $layanans = Layanan::all();

        // Kirim data ke view tujuan_informasi
        return view('buku_tamu.tujuan_informasi', compact('bukuTamu', 'layanans'));
    }

    public function update(Request $request, $id_buku_tamu)
    {
        Log::info('Update data');
        // Validasi input
        $request->validate([
            'id_layanan' => 'required|exists:layanans,id_layanan',
            'tujuan_informasi' => 'required|string|max:255',

        ]);

        // Ambil data buku tamu berdasarkan ID yang diterima dari URL
        $bukuTamu = BukuTamu::find($id_buku_tamu);

        $request->validate([
            'userAdd' => 'nullable|integer', // Pastikan data adalah integer dan bisa kosong
        ]);


        // Ambil id_bidang dari tabel layanan berdasarkan id_layanan
        $id_bidang = Layanan::find($request->input('id_layanan'))->id_bidang;


        // Update kolom id_layanan, id_bidang, dan tujuan_informasi
        $bukuTamu->id_layanan = $request->input('id_layanan');
        $bukuTamu->id_bidang = $id_bidang; // Simpan id_bidang ke buku tamu
        $bukuTamu->tujuan_informasi = $request->input('tujuan_informasi');
        $bukuTamu->save();

        // Panggil function addToDashboard setelah data buku tamu berhasil di-update
        $this->addToDashboard($id_buku_tamu);


        // return redirect()->route('success')->with('success', 'Data berhasil diperbarui');
        return redirect()->route('index')->with('success', 'Data berhasil disimpan');
    }


    public function addToDashboard($id_buku_tamu)
    {

        Log::info('Kirim ke table Dashboard Admin');
        // Ambil data dari buku tamu berdasarkan ID
        $bukuTamu = BukuTamu::find($id_buku_tamu);

        // Cek apakah data buku tamu ditemukan
        if (!$bukuTamu) {
            $bukuTamu::info('Buku Tamu ditemukan');
            return redirect()->back()->withErrors(['error' => 'Data buku tamu tidak ditemukan']);
        }

        // Ambil nilai default id_status dari tabel statuses
        $defaultStatus = Status::where('status_name', 'Pending')->first();

        print_r($defaultStatus);
        if (!$defaultStatus) {
            Log::info("Ambil nilai default");
            return redirect()->back()->withErrors(['error' => 'Default status tidak ditemukan di tabel statuses']);
        }

        // Buat data untuk dimasukkan ke dashboard_admins
        $dataDashboard = [
            'id_buku_tamu' => $bukuTamu->id_buku_tamu,
            'id_admin' => $bukuTamu->id_admin ?? 1,
            'nik' => $bukuTamu->nik,
            'nama_pegawai' => $bukuTamu->nama_pegawai,
            'jabatan_pegawai' => $bukuTamu->jabatan_pegawai,
            'unit_kerja_pegawai' => $bukuTamu->unit_kerja_pegawai,
            'tujuan_informasi' => $bukuTamu->tujuan_informasi,
            'id_bidang' => $bukuTamu->id_bidang,
            'id_layanan' => $bukuTamu->id_layanan, // Pastikan ini sudah ada dan terisi'
            'id_status' => $defaultStatus->id_status,
            'createdAdd' => now(),
            'updatedAdd' => now(),
            'userAdd' => $bukuTamu->userAdd ?? 1, // Nilai default jika user tidak ditemukan
            'created_at' => now(),
            'updated_at' => now(),
        ];


        // Simpan data ke tabel dashboard_admins
        DashboardAdmin::create($dataDashboard);

        $dataDashboard= DashboardAdmin::all();
        return view('admin.dashboard', compact('dataDashboard'));

    }

}
