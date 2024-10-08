<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert([
            ['id_status' => 1, 'status_name' => 'Pending', 'createAdd' => now(), 'updateAdd' => now(), 'userAdd' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id_status' => 2, 'status_name' => 'Process', 'createAdd' => now(), 'updateAdd' => now(), 'userAdd' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id_status' => 3, 'status_name' => 'Selesai', 'createAdd' => now(), 'updateAdd' => now(), 'userAdd' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
