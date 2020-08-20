<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDasaWisma extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dasa_wisma', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_dasa_wisma');
            $table->string('jumlah_krt');
            $table->string('jumlah_kk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dasa_wisma');
    }
}
