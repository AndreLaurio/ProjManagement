<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomExamsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_exams_audit', function (Blueprint $table) {
            $table->id('room_exams_audit_id');
            
            $table->bigInteger('modified_by')->unsigned()->default(0);
            $table->timestamp('modified_at')->useCurrent();
            $table->char('operation', 1);

            $table->bigInteger('room_id')->unsigned();
            $table->bigInteger('exam_id')->unsigned();

            $table->timestamp('open_at')->useCurrent();
            $table->timestamp('close_at')->useCurrent();
            $table->integer('time_limit')->default(0);
            $table->boolean('is_open_at_enabled')->default(false);
            $table->boolean('is_close_at_enabled')->default(false);
            $table->boolean('is_time_limit_enabled')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_exams_audit');
    }
}
