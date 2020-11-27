<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_exams', function (Blueprint $table) {
            $table->bigInteger('room_id')->unsigned();
            $table->bigInteger('exam_id')->unsigned();

            $table->timestamp('open_at')->useCurrent();
            $table->timestamp('close_at')->useCurrent();
            $table->integer('time_limit')->default(0);
            $table->boolean('is_open_at_enabled')->default(false);
            $table->boolean('is_close_at_enabled')->default(false);
            $table->boolean('is_time_limit_enabled')->default(false);
            
            $table->bigInteger('created_by')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('updated_by')->default(0);
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('room_id')
                  ->references('room_id')->on('rooms');
            $table->foreign('exam_id')
                  ->references('exam_id')->on('exams');
            
            $table->primary(['room_id', 'exam_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_exams');
    }
}
