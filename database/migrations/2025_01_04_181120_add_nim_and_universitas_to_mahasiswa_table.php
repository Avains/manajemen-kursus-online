<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('mahasiswa', function (Blueprint $table) {
        $table->string('nim')->nullable()->after('id');
        $table->string('nama_universitas')->nullable()->after('nim');
    });
}

public function down()
{
    Schema::table('mahasiswa', function (Blueprint $table) {
        $table->dropColumn(['nim', 'nama_universitas']);
    });
}

};
