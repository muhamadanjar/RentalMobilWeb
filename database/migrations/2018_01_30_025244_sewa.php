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
            //$table->unsignedInteger('karyawan_id')->nullable();
            $table->unsignedInteger('no_transaksi');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('mobil_id');

            $table->datetime('tgl_mulai')->nullable();
            $table->datetime('tgl_akhir')->nullable();
            
            $table->string('origin');
            $table->float('origin_latitude',8,5)->nullable();
            $table->float('origin_longitude',8,5)->nullable();
            $table->string('destination');
            $table->float('destination_latitude',8,5)->nullable();
            $table->float('destination_longitude',8,5)->nullable();

            $table->unsignedInteger('total_bayar')->nullable();
            $table->unsignedInteger('denda')->nullable();
            //$table->enum('status', array('cancelled', 'collected','confirmed', 'complete', 'pending'))->default('pending');
            $table->string('status',20)->default('pending');
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
