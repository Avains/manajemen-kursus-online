<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstrukturIdToKursusTable extends Migration
{
    public function up()
    {
        Schema::table('kursus', function (Blueprint $table) {
            $table->foreignId('instruktur_id')->default(1)->constrained('instruktur')->after('kategori_id');
        });
    }

    public function down()
    {
        Schema::table('kursus', function (Blueprint $table) {
            $table->dropForeign(['instruktur_id']);
            $table->dropColumn('instruktur_id');
        });
    }
}