<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogRevisions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_revisions', function ($table) {
			$table->increments('id');
			$table->string('revisionable_type',190);
			$table->integer('revisionable_id');
			$table->integer('user_id')->nullable();
			$table->integer('activity_id')->nullable();
			$table->string('key');
			$table->text('old_value')->nullable();
			$table->text('new_value')->nullable();
			$table->timestamps();

			$table->index(array('revisionable_id', 'revisionable_type'));
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_revisions');
    }
}
