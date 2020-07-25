<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePemasukanBentuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemasukan_bentuk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bentuk_id');
            $table->date('tanggal');
            $table->string('note');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
        Schema::table('pemasukan_bentuk',function (Blueprint $table){
            $table->foreign('bentuk_id')->references('id')->on('bentuk_zis');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_pemasukan_bentuk');
    }
}
