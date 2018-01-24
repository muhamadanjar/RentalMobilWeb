<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Officers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name',190);
            $table->string('nip');
            $table->unsignedInteger('pangkat_id');
            $table->unsignedInteger('jabatan_id');
            $table->enum('role', ['staff', 'operator']);
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
        Schema::table('officers', function(Blueprint $table) {
            $table->drop();
        });
    }
}
