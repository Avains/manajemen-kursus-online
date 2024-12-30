<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranKursusTable extends Migration
{
    public function up()
    {
        Schema::create('pendaftaran_kursus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa');
            $table->foreignId('kursus_id')->constrained('kursus');
            $table->date('tanggal_daftar');
            $table->enum('status', ['aktif', 'selesai', 'batal']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftaran_kursus');
    }
};
