<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MobilFasilitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('slug')->nullable();
            $table->timestamps();
        });

        Schema::create('mobil_fasilitas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mobil_id')->unsigned();
            $table->foreign('mobil_id')->references('id')->on('mobil');

            $table->integer('fasilitas_id')->unsigned();
            $table->foreign('fasilitas_id')->references('id')->on('fasilitas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('mobil_fasilitas');
        Schema::dropIfExists('fasilitas');
    }
}
