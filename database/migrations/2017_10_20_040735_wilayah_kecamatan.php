<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WilayahKecamatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wilayah_kecamatan', function (Blueprint $table) {
            $table->bigInteger('kode_kec');
            $table->string('nama_kecamatan');
            $table->bigInteger('kode_kab');
            $table->timestamps();

            $table->primary('kode_kec');
            $table->unique('kode_kec');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wilayah_kecamatan');
    }
}
