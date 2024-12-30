<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;
use App\Models\Kursus;

class PendaftaranKursus extends Model
{
    use HasFactory;
    protected $table = 'pendaftaran_kursus';

    protected $fillable = [
        'mahasiswa_id',
        'kursus_id',
        'tanggal_daftar',
        'status',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }
}