<?php

namespace Database\Factories;

use App\Models\Bidang;
use Illuminate\Database\Eloquent\Factories\Factory;

class BidangFactory extends Factory
{
    protected $model = Bidang::class;

    public function definition()
    {
        $bidang = ['ppk', 'pkd', 'mutasi', 'sekretariat'];

        return [
            'nama_bidang' => $this->faker->randomElement($bidang),
            'is_active' => 1,  // Semua bidang di-set aktif
            'userAdd' => 1,    // Misalnya ID user yang menambahkan
        ];
    }
}
