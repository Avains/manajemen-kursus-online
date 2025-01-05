<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';

    protected $fillable = [
        'nama_mahasiswa',
        'nim',
        'email',
        'telepon',
        'alamat',
        'nama_universitas',
        'foto_profil',
    ];
    

    public function pendaftaran()
    {
        return $this->hasMany(PendaftaranKursus::class);
    }
}