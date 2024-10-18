<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use App\Models\BukuTamu;
use App\Models\User; // Pastikan untuk mengimpor model User
use App\Models\Admin; // Pastikan untuk mengimpor model Admin jika diperlukan

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // // Role::factory()->count(2)->create();

        // // Buat data User terlebih dahulu
        // User::factory(10)->create();

        // // Ambil ID pengguna yang baru dibuat
        // $userIds = User::pluck('id')->toArray();

        // // Buat 10 Pegawai dengan ID pengguna yang valid
        // Pegawai::factory(10)->create(); // Factory akan menangani 'userAdd' dengan data yang valid

        // // Buat 20 Buku Tamu yang terkait dengan Pegawai
        // BukuTamu::factory(20)->create();

        // // // Membuat 2 data admin
        // // Admin::factory()->count(2)->create();

        $this->call([
            UsersSeeder::class,
            RolesSeeder::class,
            AdminSeeder::class,
            BidangsSeeder::class,
            LayanansSeeder::class,
            StatusesSeeder::class,
            PegawaisSeeder::class,
            BukuTamusSeeder::class,
            DashboardAdminsSeeder::class,
        ]);

    }


}
