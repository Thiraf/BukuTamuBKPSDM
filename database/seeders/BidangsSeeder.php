<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bidangs')->insert([
            ['id_bidang' => 1, 'nama_bidang' => 'PPK', 'is_active' => 1, 'createAdd' => now(), 'updateAdd' => now(), 'userAdd' => 1],
            ['id_bidang' => 2, 'nama_bidang' => 'PKD', 'is_active' => 1, 'createAdd' => now(), 'updateAdd' => now(), 'userAdd' => 1],
            ['id_bidang' => 3, 'nama_bidang' => 'Mutasi', 'is_active' => 1, 'createAdd' => now(), 'updateAdd' => now(), 'userAdd' => 1 ],
            ['id_bidang' => 4, 'nama_bidang' => 'Sekretariat', 'is_active' => 1, 'createAdd' => now(), 'updateAdd' => now(), 'userAdd' => 1],
        ]);
    }
}
