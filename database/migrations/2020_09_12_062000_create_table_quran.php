<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableQuran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('surah');
//            $table->unsignedBigInteger('juz_id');
            $table->timestamps();
        });

//        Schema::table('quran',function (Blueprint $table){
//            $table->foreign('juz_id')->references('id')->on('juz');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quran');
    }
}
