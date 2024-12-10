<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id_role' => 1, 'nama_role' => 'Super Admin',          'createAdd' => now(), 'updateAdd' => now(), 'userAdd' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id_role' => 2, 'nama_role' => 'Admin',                'createAdd' => now(), 'updateAdd' => now(), 'userAdd' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
