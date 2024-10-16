<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BukuTamusSeeder extends Seeder
{
    public function run()
    {
        DB::table('buku_tamus')->insert([
            [
                'id_buku_tamu' => 1,
                'id_layanan' => 1,
                'id_bidang' => 3,
                'nik' => 101,
                'nama_pegawai' => 'Budi Santoso',
                'jabatan_pegawai' => 'Manager',
                'unit_kerja_pegawai' => 'Keuangan',
                'tujuan_informasi' => 'Konsultasi Anggaran',
                'createAdd' => Carbon::now()->subHours(5),
                'updateAdd' => Carbon::now()->subHours(4),
                'userAdd' => 1,
                'created_at' => Carbon::now()->subHours(5),
                'updated_at' => Carbon::now()->subHours(4),
            ],
            [
                'id_buku_tamu' => 2,
                'id_layanan' => 1,
                'id_bidang' => 2,
                'nik' => 102,
                'nama_pegawai' => 'Siti Aminah',
                'jabatan_pegawai' => 'Staf Administrasi',
                'unit_kerja_pegawai' => 'SDM',
                'tujuan_informasi' => 'Data Pegawai',
                'createAdd' => Carbon::now()->subDays(1),
                'updateAdd' => Carbon::now()->subDays(1)->addMinutes(15),
                'userAdd' => 1,
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1)->addMinutes(15),
            ],
            [
                'id_buku_tamu' => 3,
                'id_layanan' => 1,
                'id_bidang' => 1,
                'nik' => 103,
                'nama_pegawai' => 'Ahmad Zaki',
                'jabatan_pegawai' => 'Koordinator',
                'unit_kerja_pegawai' => 'Logistik',
                'tujuan_informasi' => 'Distribusi Barang',
                'createAdd' => Carbon::now()->subMinutes(30),
                'updateAdd' => Carbon::now()->subMinutes(10),
                'userAdd' => 1,
                'created_at' => Carbon::now()->subMinutes(30),
                'updated_at' => Carbon::now()->subMinutes(10),
            ],
            [
                'id_buku_tamu' => 4,
                'id_layanan' => 1,
                'id_bidang' => 1,
                'nik' => 104,
                'nama_pegawai' => 'Ratna Dewi',
                'jabatan_pegawai' => 'Supervisor',
                'unit_kerja_pegawai' => 'Operasional',
                'tujuan_informasi' => 'Evaluasi Proyek',
                'createAdd' => Carbon::now()->subDays(2),
                'updateAdd' => Carbon::now()->subDays(2)->addHours(1),
                'userAdd' => 1,
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2)->addHours(1),
            ],
            [
                'id_buku_tamu' => 5,
                'id_layanan' => 1,
                'id_bidang' => 1,
                'nik' => 105,
                'nama_pegawai' => 'Yusuf Pratama',
                'jabatan_pegawai' => 'Analis',
                'unit_kerja_pegawai' => 'Keuangan',
                'tujuan_informasi' => 'Audit Internal',
                'createAdd' => Carbon::now()->subHours(8),
                'updateAdd' => Carbon::now()->subHours(7),
                'userAdd' => 1,
                'created_at' => Carbon::now()->subHours(8),
                'updated_at' => Carbon::now()->subHours(7),
            ],
            [
                'id_buku_tamu' => 6,
                'id_layanan' => 1,
                'id_bidang' => 1,
                'nik' => 106,
                'nama_pegawai' => 'Dian Sari',
                'jabatan_pegawai' => 'Staf',
                'unit_kerja_pegawai' => 'SDM',
                'tujuan_informasi' => 'Pelatihan Pegawai',
                'createAdd' => Carbon::now()->subDays(3),
                'updateAdd' => Carbon::now()->subDays(3)->addMinutes(45),
                'userAdd' => 1,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3)->addMinutes(45),
            ],
            [
                'id_buku_tamu' => 7,
                'id_layanan' => 1,
                'id_bidang' => 1,
                'nik' => 107,
                'nama_pegawai' => 'Farhan Aditya',
                'jabatan_pegawai' => 'Kepala Divisi',
                'unit_kerja_pegawai' => 'Logistik',
                'tujuan_informasi' => 'Pengadaan Barang',
                'createAdd' => Carbon::now()->subDays(7),
                'updateAdd' => Carbon::now()->subDays(7)->addHours(2),
                'userAdd' => 1,
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(7)->addHours(2),
            ],
            [
                'id_buku_tamu' => 8,
                'id_layanan' => 1,
                'id_bidang' => 1,
                'nik' => 108,
                'nama_pegawai' => 'Lina Kurnia',
                'jabatan_pegawai' => 'Asisten',
                'unit_kerja_pegawai' => 'Operasional',
                'tujuan_informasi' => 'Evaluasi Kerja',
                'createAdd' => Carbon::now()->subMinutes(90),
                'updateAdd' => Carbon::now()->subMinutes(30),
                'userAdd' => 1,
                'created_at' => Carbon::now()->subMinutes(90),
                'updated_at' => Carbon::now()->subMinutes(30),
            ],
            [
                'id_buku_tamu' => 9,
                'id_layanan' => 1,
                'id_bidang' => 1,
                'nik' => 109,
                'nama_pegawai' => 'Rizal Fikri',
                'jabatan_pegawai' => 'Konsultan',
                'unit_kerja_pegawai' => 'Finance',
                'tujuan_informasi' => 'Konsultasi Laporan',
                'createAdd' => Carbon::now()->subHours(6),
                'updateAdd' => Carbon::now()->subHours(5),
                'userAdd' => 1,
                'created_at' => Carbon::now()->subHours(6),
                'updated_at' => Carbon::now()->subHours(5),
            ],
            [
                'id_buku_tamu' => 10,
                'id_layanan' => 1,
                'id_bidang' => 1,
                'nik' => 110,
                'nama_pegawai' => 'Andi Rahmat',
                'jabatan_pegawai' => 'Supervisor',
                'unit_kerja_pegawai' => 'Keuangan',
                'tujuan_informasi' => 'Pemantauan Anggaran',
                'createAdd' => Carbon::now()->subHours(12),
                'updateAdd' => Carbon::now()->subHours(10),
                'userAdd' => 1,
                'created_at' => Carbon::now()->subHours(12),
                'updated_at' => Carbon::now()->subHours(10),
            ],
        ]);
    }
}
