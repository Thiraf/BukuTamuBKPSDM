<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'nama_admin' => $this->faker->name,
            'id_role' => rand(1, 2), // Asumsikan ada 2 role
            'username_admin' => $this->faker->userName,
            'password_admin' => bcrypt('password'), // Default password
            'userAdd' => rand(1, 10), // Asumsikan ada 10 pengguna
        ];
    }
}
