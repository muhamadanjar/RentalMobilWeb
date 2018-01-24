<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WilayahProvinsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wilayah_provinsi', function (Blueprint $table) {
            $table->bigInteger('kode_prov');
            $table->string('nama_provinsi');
            $table->timestamps();

            $table->primary('kode_prov');
            $table->unique('kode_prov');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wilayah_provinsi');
    }
}
