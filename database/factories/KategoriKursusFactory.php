<?php

namespace Database\Factories;

use App\Models\KategoriKursus;
use Illuminate\Database\Eloquent\Factories\Factory;

class KategoriKursusFactory extends Factory
{
    protected $model = KategoriKursus::class;

    public function definition()
    {
        return [
            'nama_kategori' => $this->faker->word,
            'deskripsi' => $this->faker->sentence,
        ];
    }
}