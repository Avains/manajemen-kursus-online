<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruktur extends Model
{
    use HasFactory;
    protected $table = 'instruktur'; 
    protected $fillable = [
        'nama_instruktur',
        'npm',
        'email',
        'telepon',
        'alamat',
    ];
    public function kursus()
    {
        return $this->hasMany(Kursus::class);
    }
}