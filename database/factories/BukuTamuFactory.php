<?php

namespace Database\Factories;

use App\Models\BukuTamu;
use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\Factory;

class BukuTamuFactory extends Factory
{
    protected $model = BukuTamu::class;

    public function definition()
    {
        return [
            'id_pegawai' => Pegawai::factory(), // Menghubungkan dengan factory Pegawai
            'id_bidang' => Bidang::factory(),
            'id_layanan' => Layanan::factory(),
            'tujuan_informasi' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['Pending', 'Process', 'Selesai']),
        ];
    }
}

