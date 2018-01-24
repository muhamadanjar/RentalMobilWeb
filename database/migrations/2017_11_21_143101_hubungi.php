<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hubungi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hubungi', function(Blueprint $table){
	        $table->increments('id');
	        $table->string('nama',100);
	        $table->string('email',50);
            $table->string('pesan',190);
            $table->timestamp('posted_at');
            $table->enum('dibaca',array('1','0'))->default(0);
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
        Schema::dropIfExists('hubungi');
    }
}
