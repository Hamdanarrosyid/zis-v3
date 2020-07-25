<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemasukanZisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemasukan_zis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('jenis_id');
            $table->date('tanggal');
            $table->decimal('nominal',65);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
        Schema::table('pemasukan_zis',function (Blueprint $table){
           $table->foreign('jenis_id')->references('id')->on('jenis_zis');
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
        Schema::dropIfExists('pemasukan_zis');
    }
}
