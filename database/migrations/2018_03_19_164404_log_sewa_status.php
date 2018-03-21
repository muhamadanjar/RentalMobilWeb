<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class LogSewaStatus extends Migration{
    
    public function up()
    {
        Schema::create('log_sewa_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sewa_id');
            $table->timestamp('waktu');
            $table->string('status',1);
            
            $table->timestamps();
        });

        \DB::unprepared('
        CREATE TRIGGER before_sewa_status_update BEFORE UPDATE ON sewa FOR EACH ROW
            BEGIN
                INSERT INTO log_sewa_status (`sewa_id`, `waktu`, `status`) 
                VALUES (OLD.id, now(), OLD.status);
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('log_sewa_status');
        \DB::unprepared('DROP TRIGGER before_sewa_status_update');
    }
}
