<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['id' => 1, 'name' => 'User 1', 'email' => 'user1@example.com', 'password' => Hash::make('UserPertama'), 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'User 2', 'email' => 'user2@example.com', 'password' => Hash::make('UserKedua'),   'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
