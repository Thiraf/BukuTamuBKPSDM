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
            'id_role' => rand(1, 2),
            'username_admin' => $this->faker->userName,
            'password_admin' => bcrypt('password'),
            'userAdd' => rand(1, 10),
        ];
    }
}
