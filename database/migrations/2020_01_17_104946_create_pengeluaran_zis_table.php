<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengeluaranZisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran_zis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('keperluan');
            $table->unsignedBigInteger('jenis_id');
            $table->date('tanggal');
            $table->decimal('nominal',65);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
        Schema::table('pengeluaran_zis',function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('jenis_id')->references('id')->on('jenis_zis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengeluaran_zis');
    }
}
