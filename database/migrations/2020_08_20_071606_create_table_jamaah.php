<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableJamaah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jamaah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->unsignedBigInteger('jenis_kelamin_id');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->unsignedBigInteger('dasa_wisma_id');
            $table->unsignedBigInteger('rt_id');
            $table->unsignedBigInteger('warga_id');
            $table->unsignedBigInteger('golongan_darah_id');
            $table->string('keterangan');
            $table->timestamps();
        });
        Schema::table('jamaah',function (Blueprint $table){
            $table->foreign('jenis_kelamin_id')->references('id')->on('jenis_kelamin');
            $table->foreign('dasa_wisma_id')->references('id')->on('dasa_wisma');
            $table->foreign('rt_id')->references('id')->on('rt');
            $table->foreign('warga_id')->references('id')->on('warga');
            $table->foreign('golongan_darah_id')->references('id')->on('golongan_darah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jamaah');
    }
}
