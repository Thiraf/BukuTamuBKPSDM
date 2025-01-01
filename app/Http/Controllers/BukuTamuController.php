<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use App\Models\BukuTamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Layanan;
use App\Models\DashboardAdmin;
use App\Models\Status;
use Illuminate\Support\Facades\Validator;




class BukuTamuController
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

    public function cekNIP(Request $request)
    {
        Log::info('Masuk ke Function Cek Nip');

        $validator = Validator::make($request->all(), [
            'nip' => 'required|numeric',
            'captcha' => 'required|captcha',
        ], [
            'captcha.captcha' => 'Captcha salah, silahkan coba lagi.',
            'nip.numeric' => 'ID harus berupa angka.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $nip = $request->input('nip');

        $token = $this->getApiToken();

        Log::info('Token API yang didapatkan:', ['token' => $token]);

        $client = new Client();
        $response = $client->post('https://asn-api.bantulkab.go.id/wsgo/simpeg/Profil', [
            'json' => [
                'Nip' => $nip
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ]
        ]);

        $profileData = json_decode($response->getBody()->getContents(), true);

        Log::info('Respons API Profil:', ['response' => $profileData]);

        if (!empty($profileData) && isset($profileData['Data']) && !empty($profileData['Data'][0])) {
            Log::info('Data pegawai ditemukan di API:', ['pegawai' => $profileData['Data'][0]]);

            session(['nip' => $nip]);
            session(['pegawai' => $profileData['Data'][0]]);
            session(['data_source' => 'api']);
            return redirect()->route('buku_tamu.data_pekerja');
        } else {
            Log::info('Data pegawai tidak ditemukan di API, coba cari di database lokal.');

            $pegawai = DB::table('buku_tamus')->where('nip', $nip)->first();

            if ($pegawai) {
                Log::info('Data pegawai ditemukan di tabel buku_tamus:', ['pegawai' => $pegawai]);

                session(['nip' => $nip]);
                session(['pegawai' => $pegawai]);
                session(['data_source' => 'local']);
                return redirect()->route('buku_tamu.data_pekerja');
            } else {
                Log::info('Data pegawai tidak ditemukan di API maupun di tabel buku_tamus. Mengarahkan ke form pekerja baru.');

                session(['nip' => $nip]);
                return redirect()->route('buku_tamu.form_pekerja_baru');
            }
        }
    }



    public function showDataPekerja(Request $request)
    {
        Log::info('Show Data Pekerja');

        if (!$request->session()->has('nip')) {
            return redirect()->route('buku_tamu.cek_nip')->withErrors('Silakan masukkan NIP terlebih dahulu.');
        }
        Log::info('Cek session NIP:', ['session_nip' => $request->session()->get('nip')]);

        $pegawai = session('pegawai');

        return view('buku_tamu.data_pekerja', compact('pegawai'));
    }

    public function formPekerjaBaru(Request $request)
    {
        Log::info('Masuk ke Function Form Pekerja Baru');

        if (!$request->session()->has('nip')) {
            return redirect()->route('buku_tamu.cek_nip')->withErrors('Silakan masukkan NIP terlebih dahulu.');
        }
        Log::info('Cek session NIP:', ['session_nip' => $request->session()->get('nip')]);


        $nip = $request->session()->get('nip');

        return view('buku_tamu.form_pekerja_baru', compact('nip'));
    }

    public function simpanPegawai(Request $request)
    {
        Log::info('Masuk ke Function Simpan Pegawai');

        Log::info('Cek session NIP:', ['session_nip' => $request->session()->get('nip')]);

        $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'jabatan_pegawai' => 'required|string|max:255',
            'unit_kerja_pegawai' => 'required|string|max:255',
        ]);
        Log::info('cek');

        $nip = session('nip');

        $bukuTamuId = DB::table('buku_tamus')->insertGetId([
            'nip' => $nip,
            'nama_pegawai' => $request->nama_pegawai,
            'jabatan_pegawai' => $request->jabatan_pegawai,
            'unit_kerja_pegawai' => $request->unit_kerja_pegawai,
            'created_at' => now(),
            'updated_at' => now(),
            'userAdd' => $bukuTamu->userAdd ?? 1,
        ]);

        return redirect()->route('tujuan_informasi', ['id' => $bukuTamuId])
            ->with('success', 'Data pegawai berhasil disimpan.');
    }


    public function tujuanInformasi(Request $request, $id)
    {

        Log::info('Simpan Pegawai Berhasil dilakukan');

        Log::info('Cek session NIP:', ['session_nip' => $request->session()->get('nip')]);

        $bukuTamu = DB::table('buku_tamus')->where('id_buku_tamu', $id)->first();
        $layanans = Layanan::all();

        session()->forget('nip');

        return view('buku_tamu.tujuan_informasi', compact('bukuTamu', 'layanans'));
    }


    public function update(Request $request, $id_buku_tamu)
    {
        Log::info('Update data');

        $request->validate([
            'id_layanan' => 'required|exists:layanans,id_layanan',
            'tujuan_informasi' => 'required|string|max:255',
            'userAdd' => 'nullable|integer',
        ]);


        $bukuTamu = BukuTamu::findOrFail($id_buku_tamu);

        $id_bidang = Layanan::where('id_layanan', $request->input('id_layanan'))->value('id_bidang');

        $bukuTamu->id_layanan = $request->input('id_layanan');
        $bukuTamu->id_bidang = $id_bidang;
        $bukuTamu->tujuan_informasi = $request->input('tujuan_informasi');
        $bukuTamu->save();

        $this->addToDashboard($id_buku_tamu);

        session()->forget('nip');

        return redirect()->route('index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function addToDashboard($id_buku_tamu)
    {

        Log::info('Kirim ke table Dashboard Admin');
        $bukuTamu = BukuTamu::find($id_buku_tamu);

        if (!$bukuTamu) {
            $bukuTamu::info('Buku Tamu ditemukan');
            return redirect()->back()->withErrors(['error' => 'Data buku tamu tidak ditemukan']);
        }

        $defaultStatus = Status::where('status_name', 'Pending')->first();

        if (!$defaultStatus) {
            Log::info("Ambil nilai default");
            return redirect()->back()->withErrors(['error' => 'Default status tidak ditemukan di tabel statuses']);
        }

        $dataDashboard = [
            'id_buku_tamu' => $bukuTamu->id_buku_tamu,
            'id_admin' => $bukuTamu->id_admin ?? 1,
            'nip' => $bukuTamu->nip,
            'nama_pegawai' => $bukuTamu->nama_pegawai,
            'jabatan_pegawai' => $bukuTamu->jabatan_pegawai,
            'unit_kerja_pegawai' => $bukuTamu->unit_kerja_pegawai,
            'tujuan_informasi' => $bukuTamu->tujuan_informasi,
            'id_bidang' => $bukuTamu->id_bidang,
            'id_layanan' => $bukuTamu->id_layanan,
            'id_status' => $defaultStatus->id_status,
            'createAdd' => now(),
            'updateAdd' => now(),
            'userAdd' => $bukuTamu->userAdd ?? 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DashboardAdmin::create($dataDashboard);

        $dataDashboard= DashboardAdmin::all();
        return redirect()->route('admin.dashboard')->with('success', 'Data berhasil ditambahkan');


    }
}
