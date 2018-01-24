<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Post extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('author_id')->default(0);
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title',190);
            $table->text('content');
            $table->enum('type_post', array('post','page','kegiatan','lowongan'));
            $table->enum('status', array('published','draft'));
            $table->enum('position', array('main','manual'));
            $table->string('slug',190)->unique();
            $table->string('image',190)->nullable();
            $table->integer('category_id')->nullable()->unsigned();
            //$table->boolean('active')->default(0);
            $table->integer('dibaca');
            $table->integer('sticky')->nullable()->default(0);
            $table->datetime('posted_at')->nullable();
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
        /*Schema::table('posts', function(Blueprint $table) {
            $table->dropIndex('search');
            $table->drop();
        });*/
        Schema::dropIfExists('posts');
    }
}
