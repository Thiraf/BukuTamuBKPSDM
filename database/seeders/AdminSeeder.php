<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('admins')->insert([
            'nama_admin' => 'Super Admin',
            'username_admin' => 'Super',
            'password_admin' => bcrypt('superadmin'), // Hash password
            'id_role' => 1,
            'createAdd' => now(),
            'updateAdd' => now(),
            'userAdd' => 1, // Default value atau bisa diubah jika sesuai dengan user
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('admins')->insert([
            'nama_admin' => 'Admins',
            'username_admin' => 'Admins',
            'password_admin' => bcrypt('adminsbiasa'), // Hash password
            'id_role' => 2,
            'createAdd' => now(),
            'updateAdd' => now(),
            'userAdd' => 1, // Default value atau bisa diubah jika sesuai dengan user
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }

}
