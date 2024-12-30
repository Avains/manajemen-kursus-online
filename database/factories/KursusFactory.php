<?php

// database/factories/KursusFactory.php
namespace Database\Factories;

use App\Models\Kursus;
use App\Models\KategoriKursus;
use Illuminate\Database\Eloquent\Factories\Factory;

class KursusFactory extends Factory
{

    
    protected $model = Kursus::class;

    
    public function definition()
    {
        return [
            'nama_kursus' => $this->faker->sentence(3),
            'deskripsi' => $this->faker->paragraph,
            'durasi' => $this->faker->numberBetween(1, 100),
            'kategori_id' => KategoriKursus::factory(),
        ];
    }
}