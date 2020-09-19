<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePencapaianbaca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pencapaianbaca', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tingkatbaca_id');
            $table->bigInteger('nomor_pencapaian');
            $table->timestamps();
        });
//        Schema::table('pencapaianbaca',function (Blueprint $table){
//           $table->foreign('tingkatbaca_id')->references('id')->on('tingkatbaca');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pencapaianbaca');
    }
}
