<?php

namespace Database\Factories;

use App\Models\Kursus;
use App\Models\Mahasiswa;
use App\Models\PendaftaranKursus;
use Illuminate\Database\Eloquent\Factories\Factory;

class PendaftaranKursusFactory extends Factory
{
    protected $model = PendaftaranKursus::class;

    public function definition()
    {
        return [
            'mahasiswa_id' => Mahasiswa::factory(),
            'kursus_id' => Kursus::factory(),
            'tanggal_daftar' => $this->faker->date(),
            'status' => $this->faker->randomElement(['aktif', 'selesai', 'batal']),
        ];
    }
}