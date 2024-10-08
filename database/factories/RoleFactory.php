<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        return [
            'role' => $this->faker->randomElement(['Admin', 'Super Admin']),
            'userAdd' => 1,  // atau bisa menggunakan User::factory()->create()->id jika perlu
        ];
    }
}
