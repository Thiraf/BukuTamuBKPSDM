<?php

namespace Database\Factories;

use App\Models\Layanan;
use App\Models\Bidang;
use Illuminate\Database\Eloquent\Factories\Factory;

class LayananFactory extends Factory
{
    protected $model = Layanan::class;

    public function definition()
    {
        // Layanan berdasarkan bidang
        $layananByBidang = [
            'ppk' => [
                'Layanan Karis Karsu',
                'Layanan Konsultasi Presensi',
                'Layanan Konsultasi Cerai',
                'Layanan Konsultasi Cuti',
                'Layanan Konsultasi Satyalancana',
                'Layanan Konsultasi Hukuman Disiplin',
                'Layanan Konsultasi TPP',
                'Layanan Konsultasi Jaminan Kematian'
            ],
            'pkd' => [
                'Layanan Konsultasi Diklat',
                'Layanan Konsultasi Jabatan Fungsional',
                'Layanan Konsultasi Tugas Belajar/Pendidikan Lanjutan',
                'Layanan Konsultasi Assesment'
            ],
            'mutasi' => [
                'Layanan Konsultasi Pengembangan Karir',
                'Layanan Konsultasi Mutasi Masuk',
                'Layanan Konsultasi Mutasi Keluar',
                'Layanan Konsultasi SK',
                'Layanan Konsultasi Kenaikan Pangkat',
                'Layanan Konsultasi Kenaikan Jenjang',
                'Layanan Konsultasi PUPNS',
                'Layanan Konsultasi SAPA ASN',
                'Layanan Konsultasi SIASN/MYASN',
                'Layanan Konsultasi Pendaftaran CASN/CPNS/PPPPK'
            ],
            'sekretariat' => [
                'Layanan Penawaran',
                'Layanan lain-lain'
            ],
        ];

        // Pilih bidang secara acak
        $bidang = Bidang::inRandomOrder()->first();
        $layanan = $layananByBidang[$bidang->nama_bidang] ?? [];

        return [
            'nama_layanan' => $this->faker->randomElement($layanan),  // Pilih random layanan berdasarkan bidang
            'id_bidang' => $bidang->id,  // Hubungkan layanan dengan bidang
            'userAdd' => 1,  // ID pengguna yang menambahkan data
        ];
    }
}
