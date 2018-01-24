<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WilayahKabupaten extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wilayah_kabupaten', function (Blueprint $table) {
            $table->bigInteger('kode_kab');
            $table->string('nama_kabupaten');
            $table->bigInteger('kode_prov');
            $table->timestamps();

            $table->primary('kode_kab');
            $table->unique('kode_kab');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wilayah_kabupaten');
    }
}
