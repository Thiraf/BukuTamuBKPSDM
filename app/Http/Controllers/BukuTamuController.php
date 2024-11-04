<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

use App\Models\Pegawai;
use App\Models\BukuTamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Layanan;
use App\Models\DashboardAdmin;
use App\Models\Status;
use Illuminate\Support\Facades\Validator;




class BukuTamuController extends Controller
{

    protected $adminController;

    public function __construct(AdminController $adminController)
    {
        $this->adminController = $adminController;
    }

    private function getApiToken()
    {
        try {
            if (Cache::has('api_token')) {
                return Cache::get('api_token');
            }

            $client = new Client();
            $response = $client->post('https://asn-api.bantulkab.go.id/wsgo/getToken', [
                'json' => [
                    'username' => 'dabinkes',
                    'password' => 'S4tu&Duw4'
                ],
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);

            $data = json_decode($response->getBody()->getContents());

            if (isset($data->token)) {
                Cache::put('api_token', $data->token, now()->addHour());
                return $data->token;
            } else {
                throw new \Exception("Token not found in response");
            }
        } catch (\Exception $e) {
            Log::error('Failed to get API token: ' . $e->getMessage());
            abort(500, 'Unable to authenticate with the API');
        }
    }



    // public function cekNIK(Request $request)
    // {

    //     // Log informasi untuk request POST
    //     Log::info('Masuk ke Function Cek Nik');

    //     // Validasi input NIK dan CAPTCHA
    //     $validator = Validator::make($request->all(), [
    //         'nik' => 'required',
    //         'captcha' => 'required|captcha', // Validasi CAPTCHA
    //     ], [
    //         'captcha.captcha' => 'Captcha salah, silahkan coba lagi.', // Pesan error khusus untuk captcha
    //     ]);

    //     // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator) // Kirim error ke view
    //             ->withInput(); // Simpan input sebelumnya
    //     }

    //     // Validasi input NIK
    //     $nik = $request->input('nik');

    //     // Cari data pegawai berdasarkan NIK
    //     $pegawai = Pegawai::where('nik', $nik)->first();

    //     if ($pegawai) {
    //         // Simpan data ke session jika ditemukan
    //         session(['nik' => $nik]);
    //         session(['pegawai' => $pegawai]);
    //         // Jika data pegawai ditemukan, arahkan ke halaman data_pekerja
    //         return redirect()->route('buku_tamu.data_pekerja'); // Pastikan ada route untuk ini
    //     } else {
    //         // Jika data pegawai tidak ditemukan, arahkan ke halaman form_pekerja_baru dengan NIK
    //         session(['nik' => $nik]);
    //         return redirect()->route('buku_tamu.form_pekerja_baru'); // Pastikan ada route untuk ini
    //     }
    // }

    public function cekNIK(Request $request)
    {
        Log::info('Masuk ke Function Cek Nik');

        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'captcha' => 'required|captcha',
        ], [
            'captcha.captcha' => 'Captcha salah, silahkan coba lagi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $nik = $request->input('nik');

        // Dapatkan token API
        $token = $this->getApiToken();

        // Log untuk memastikan token berhasil diambil
        Log::info('Token API yang didapatkan:', ['token' => $token]);

        // Panggil API untuk memeriksa NIK
        $client = new Client();
        $response = $client->post('https://asn-api.bantulkab.go.id/wsgo/simpeg/Profil', [
            'json' => [
                'Nip' => $nik
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ]
        ]);

        // Decode response JSON
        $profileData = json_decode($response->getBody()->getContents(), true);

        // Log response API untuk memastikan struktur data
        Log::info('Respons API Profil:', ['response' => $profileData]);

        // Cek apakah profil ditemukan
        if (!empty($profileData) && isset($profileData['Data']) && !empty($profileData['Data'][0])) {
            Log::info('Data pegawai ditemukan di API:', ['pegawai' => $profileData['Data'][0]]);

            // Simpan data pegawai dari API ke session
            session(['nik' => $nik]);
            session(['pegawai' => $profileData['Data'][0]]); // Sesuaikan dengan struktur data API
            session(['data_source' => 'api']); // Tandai bahwa data berasal dari API
            return redirect()->route('buku_tamu.data_pekerja');
        } else {
            Log::info('Data pegawai tidak ditemukan di API, coba cari di database lokal.');

            // Jika data pegawai tidak ditemukan di API, coba cari di database lokal
            $pegawai = Pegawai::where('nik', $nik)->first();

            if ($pegawai) {
                Log::info('Data pegawai ditemukan di database lokal:', ['pegawai' => $pegawai]);

                // Jika data ditemukan di database, simpan ke session
                session(['nik' => $nik]);
                session(['pegawai' => $pegawai]);
                session(['data_source' => 'local']); // Tandai bahwa data berasal dari database lokal
                return redirect()->route('buku_tamu.data_pekerja');
            } else {
                Log::info('Data pegawai tidak ditemukan di API maupun database lokal. Mengarahkan ke form pekerja baru.');

                // Jika data pegawai tidak ditemukan di API maupun di database, arahkan ke form pekerja baru
                session(['nik' => $nik]);
                return redirect()->route('buku_tamu.form_pekerja_baru');
            }
        }
    }






    public function showDataPekerja(Request $request)
    {
        Log::info('Show Data Pekerja');

        if (!$request->session()->has('nik')) {
            return redirect()->route('buku_tamu.cek_nik')->withErrors('Silakan masukkan NIK terlebih dahulu.');
        }
        Log::info('Cek session NIK:', ['session_nik' => $request->session()->get('nik')]);

        $pegawai = session('pegawai');

        return view('buku_tamu.data_pekerja', compact('pegawai'));
    }

    public function formPekerjaBaru(Request $request)
    {
        Log::info('Masuk ke Function Form Pekerja Baru');

        if (!$request->session()->has('nik')) {
            return redirect()->route('buku_tamu.cek_nik')->withErrors('Silakan masukkan NIK terlebih dahulu.');
        }
        Log::info('Cek session NIK:', ['session_nik' => $request->session()->get('nik')]);


        $nik = $request->session()->get('nik');

        return view('buku_tamu.form_pekerja_baru', compact('nik'));
    }

    public function simpanPegawai(Request $request)
    {
        Log::info('Masuk ke Function Simpan Pegawai');

        Log::info('Cek session NIK:', ['session_nik' => $request->session()->get('nik')]);


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


    public function tujuanInformasi(Request $request, $id)
    {

        Log::info('Simpan Pegawai Berhasil dilakukan');

        Log::info('Cek session NIK:', ['session_nik' => $request->session()->get('nik')]);


        // Ambil data buku tamu berdasarkan ID
        $bukuTamu = DB::table('buku_tamus')->where('id_buku_tamu', $id)->first();
        $layanans = Layanan::all();

        session()->forget('nik');

        // Kirim data ke view tujuan_informasi
        return view('buku_tamu.tujuan_informasi', compact('bukuTamu', 'layanans'));
    }


    public function update(Request $request, $id_buku_tamu)
    {
        Log::info('Update data'); // Logging informasi

        // Validasi input
        $request->validate([
            'id_layanan' => 'required|exists:layanans,id_layanan', // Pastikan id_layanan valid
            'tujuan_informasi' => 'required|string|max:255', // Pastikan tujuan_informasi tidak kosong
            'userAdd' => 'nullable|integer', // Optional field yang harus integer atau null
        ]);

        // Ambil data buku tamu berdasarkan ID dari URL
        $bukuTamu = BukuTamu::findOrFail($id_buku_tamu); // findOrFail untuk memastikan data ada

        // Ambil id_bidang dari tabel layanan berdasarkan id_layanan yang diinput
        $id_bidang = Layanan::where('id_layanan', $request->input('id_layanan'))->value('id_bidang');

        // Update kolom id_layanan, id_bidang, dan tujuan_informasi di buku tamu
        $bukuTamu->id_layanan = $request->input('id_layanan');
        $bukuTamu->id_bidang = $id_bidang; // Simpan id_bidang ke buku tamu
        $bukuTamu->tujuan_informasi = $request->input('tujuan_informasi');
        $bukuTamu->save(); // Simpan perubahan

        // Panggil function addToDashboard setelah data buku tamu berhasil di-update
        $this->addToDashboard($id_buku_tamu);

        // Hapus session NIK
        session()->forget('nik');

        // Redirect dengan pesan sukses
        return redirect()->route('index')
            ->with('success', 'Data berhasil disimpan');

        // Redirect ke URL tertentu setelah data berhasil di-update
        // return redirect()->away('https://skm.bantulkab.go.id/opd-eccbc87e4b5ce2fe28308fd9f2a7baf3.asp')
        // ->with('success', 'Data berhasil disimpan');
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
        return redirect()->route('admin.dashboard')->with('success', 'Data berhasil ditambahkan');


    }

}
