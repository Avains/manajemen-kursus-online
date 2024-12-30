<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kursus extends Model
{
    use HasFactory;

    protected $table = 'kursus';
    protected $fillable = [
        'nama_kursus',
        'deskripsi',
        'durasi',
        'kategori_id',
        'instruktur_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriKursus::class);
    }

    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class);
    }
    
    public function pendaftaran()
    {
        return $this->hasMany(PendaftaranKursus::class);
    }
}