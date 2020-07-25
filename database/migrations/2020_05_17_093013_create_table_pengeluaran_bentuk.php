<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePengeluaranBentuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran_bentuk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('keperluan');
            $table->unsignedBigInteger('bentuk_id');
            $table->date('tanggal');
            $table->string('note');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
        Schema::table('pengeluaran_bentuk',function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('bentuk_id')->references('id')->on('bentuk_zis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_pengeluaran_bentuk');
    }
}
