<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrukturTable extends Migration
{
    public function up()
    {
        Schema::create('instruktur', function (Blueprint $table) {
            $table->id();
            $table->string('nama_instruktur');
            $table->string('email')->unique();
            $table->string('telepon');
            $table->text('alamat');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('instruktur');
    }
};
