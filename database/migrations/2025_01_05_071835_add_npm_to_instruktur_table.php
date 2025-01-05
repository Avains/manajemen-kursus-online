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
    Schema::table('instruktur', function (Blueprint $table) {
        $table->bigInteger('npm')->nullable()->after('nama_instruktur'); // Tambahkan kolom npm
    });
}

public function down()
{
    Schema::table('instruktur', function (Blueprint $table) {
        $table->dropColumn('npm'); // Hapus kolom npm jika rollback
    });
}

};
