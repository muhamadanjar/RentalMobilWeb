<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogActivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_activities', function(Blueprint $table)
		{
			$table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->string('subject_type',190);
            $table->string('predicate',190)->nullable();
            $table->unsignedBigInteger('object_id')->nullable();
            $table->string('object_type',190)->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->index(['subject_id', 'subject_type']);
            $table->index('predicate');
            $table->index(['object_id', 'object_type']);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_activities');
    }
}
