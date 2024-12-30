<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKursus extends Model
{
    use HasFactory;
    // app/Models/KategoriKursus.php
    protected $table = 'kategori_kursus';
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    public function kursus()
    {
        return $this->hasMany(Kursus::class);
    }
}