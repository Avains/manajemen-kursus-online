<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('mahasiswa', function (Blueprint $table) {
        $table->string('foto_profil')->nullable()->after('alamat'); // Menambahkan kolom setelah alamat
    });
}

public function down()
{
    Schema::table('mahasiswa', function (Blueprint $table) {
        $table->dropColumn('foto_profil');
    });
}

};
