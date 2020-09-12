<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSantri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_santri');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->unsignedBigInteger('jenis_kelamin_id');
            $table->unsignedBigInteger('sekolah_id');
            $table->unsignedBigInteger('tingkat_baca');
            $table->unsignedBigInteger('nilai_id');
            $table->timestamps();
        });
        Schema::table('santri',function (Blueprint $table){
            $table->foreign('jenis_kelamin_id')->references('id')->on('jenis_kelamin');
            $table->foreign('sekolah_id')->references('id')->on('sekolah');
            $table->foreign('nilai_id')->references('id')->on('nilai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('santri');
    }
}
