<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Customer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('sex',array('Laki-laki','Perempuan'));
            $table->string('name')->nullable();
            $table->string('religion')->nullable();
            $table->date('tgl_lahir');
            $table->string('address')->nullable();
            $table->string('city_id')->nullable();
            $table->string('job')->nullable();
            $table->string('nationality')->nullable();
            $table->string('education')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
