<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pegawais')->insert([
            [
                'id_pegawai'=>'1',
                'nip' => '123',
                'nama_pegawai' => 'John Doe',
                'jabatan_pegawai' => 'Manager',
                'unit_kerja_pegawai' => 'Finance',
                'id_bidang' => 1,
                'id_layanan' => 1,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pegawai'=>'2',
                'nip' => '321',
                'nama_pegawai' => 'Jane Smith',
                'jabatan_pegawai' => 'Staff',
                'unit_kerja_pegawai' => 'IT',
                'id_bidang' => 2,
                'id_layanan' => 2,
                'createAdd' => now(),
                'updateAdd' => now(),
                'userAdd' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
