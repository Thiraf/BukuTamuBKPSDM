<?php

namespace Database\Factories;

use App\Models\Pegawai;
use App\Models\User; // Import model User
use Illuminate\Database\Eloquent\Factories\Factory;

class PegawaiFactory extends Factory
{
    protected $model = Pegawai::class;

    public function definition()
    {
        // Ambil ID pengguna yang ada
        $userIds = User::pluck('id')->toArray();

        // Menghasilkan bidang secara acak
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

        $kotaByIndonesia = [
            'Jakarta', 
            'Surabaya', 
            'Bandung', 
            'Medan', 
            'Semarang', 
            'Makassar', 
            'Palembang', 
            'Denpasar', 
            'Yogyakarta', 
            'Malang', 
            'Balikpapan', 
            'Pontianak', 
            'Banjarmasin', 
            'Pekanbaru', 
            'Batam', 
            'Manado', 
            'Padang', 
            'Samarinda', 
            'Tasikmalaya', 
            'Cirebon'
        ];



        $bidang = $this->faker->randomElement(array_keys($layananByBidang));
        $layanan = $this->faker->randomElement($layananByBidang[$bidang]);
        // Pilih kota secara acak dari array
        $tempat_lahir = $this->faker->randomElement($kotaByIndonesia);

        return [
            'nik' => $this->faker->unique()->numerify('##########'),
            'nama' => $this->faker->name,
            'bidang' => $bidang,
            'layanan' => $layanan,
            'instansi' => $this->faker->company,
            'nomor_hp' => $this->faker->numerify('###########'),
            // 'tempat_tanggal_lahir' => $this->faker->date(),

            // Menggabungkan tempat lahir dan tanggal lahir
            'tempat_tanggal_lahir' => $tempat_lahir . ', ' . $this->faker->date(),


            'userAdd' => $this->faker->randomElement($userIds), // Gunakan ID pengguna yang valid
        ];
    }
}
