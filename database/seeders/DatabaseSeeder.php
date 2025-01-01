<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        $this->call([
            UsersSeeder::class,
            RolesSeeder::class,
            AdminSeeder::class,
            BidangsSeeder::class,
            LayanansSeeder::class,
            StatusesSeeder::class,
            BukuTamusSeeder::class,
            DashboardAdminsSeeder::class,
        ]);

    }


}
