<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sewa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sewa', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('karyawan_id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('mobil_id');

            $table->datetime('tgl_pinjam');
            $table->datetime('tgl_kembali');
            
            $table->unsignedInteger('total_bayar')->nullable();
            $table->unsignedInteger('denda')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sewa', function(Blueprint $table) {
            $table->drop();
        });
    }
}
