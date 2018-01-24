<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WilayahDesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wilayah_desa', function (Blueprint $table) {
            $table->bigInteger('kode_desa');
            $table->string('nama_desa');
            $table->bigInteger('kode_kec');
            $table->timestamps();

            $table->primary('kode_desa');
            $table->unique('kode_desa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wilayah_desa');
    }
}
