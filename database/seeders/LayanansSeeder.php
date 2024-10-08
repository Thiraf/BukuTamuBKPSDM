<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayanansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('layanans')->insert([
            [
                'id_layanan' => 1,
                'nama_layanan' => 'Layanan Karis Karsu',
                'id_bidang' => 1,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 2,
                'nama_layanan' => 'Layanan Konsultasi Presensi',
                'id_bidang' => 1,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 3,
                'nama_layanan' => 'Layanan Konsultasi Cerai',
                'id_bidang' => 1,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 4,
                'nama_layanan' => 'Layanan Konsultasi Cuti',
                'id_bidang' => 1,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 5,
                'nama_layanan' => 'Layanan Konsultasi Satyalancana',
                'id_bidang' => 1,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 6,
                'nama_layanan' => 'Layanan Konsultasi Hukuman Disiplin',
                'id_bidang' => 1,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 7,
                'nama_layanan' => 'Layanan Konsultasi TPP',
                'id_bidang' => 1,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 8,
                'nama_layanan' => 'Layanan Konsultasi Jaminan Kematian',
                'id_bidang' => 1,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 9,
                'nama_layanan' => 'Layanan Konsultasi Diklat',
                'id_bidang' => 2,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 10,
                'nama_layanan' => 'Layanan Konsultasi Jabatan Fungsional',
                'id_bidang' => 2,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 11,
                'nama_layanan' => 'Layanan Konsultasi Tugas Belajar/Pendidikan Lanjutan',
                'id_bidang' => 2,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 12,
                'nama_layanan' => 'Layanan Konsultasi Assessment',
                'id_bidang' => 2,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 13,
                'nama_layanan' => 'Layanan Konsultasi Pengembangan Karir',
                'id_bidang' => 3,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 14,
                'nama_layanan' => 'Layanan Konsultasi Mutasi Masuk',
                'id_bidang' => 3,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 15,
                'nama_layanan' => 'Layanan Konsultasi Mutasi Keluar',
                'id_bidang' => 3,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 16,
                'nama_layanan' => 'Layanan Konsultasi SK',
                'id_bidang' => 3,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 17,
                'nama_layanan' => 'Layanan Konsultasi Kenaikan Pangkat',
                'id_bidang' => 3,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 18,
                'nama_layanan' => 'Layanan Konsultasi Kenaikan Jenjang',
                'id_bidang' => 3,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 19,
                'nama_layanan' => 'Layanan Konsultasi PUPNS',
                'id_bidang' => 3,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 20,
                'nama_layanan' => 'Layanan Konsultasi SAPA ASN',
                'id_bidang' => 3,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 21,
                'nama_layanan' => 'Layanan Konsultasi SIASN/MYASN',
                'id_bidang' => 3,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 22,
                'nama_layanan' => 'Layanan Konsultasi Pendaftaran CASN/CPNS/PPPPK',
                'id_bidang' => 3,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 23,
                'nama_layanan' => 'Layanan Konsultasi Penawaran',
                'id_bidang' => 4,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_layanan' => 24,
                'nama_layanan' => 'Layanan lain-lain',
                'id_bidang' => 4,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
