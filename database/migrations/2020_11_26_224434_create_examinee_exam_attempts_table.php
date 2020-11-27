<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamineeExamAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinee_exam_attempts', function (Blueprint $table) {
            $table->bigInteger('room_id')->unsigned();
            $table->bigInteger('examinee_id')->unsigned();
            $table->bigInteger('exam_id')->unsigned();
            $table->timestamp('attempt_at')->useCurrent();

            $table->string('attempt_ip', 50)->nullable();
            $table->string('attempt_device')->nullable();
            
            $table->bigInteger('created_by')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('updated_by')->default(0);
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('room_id', 'eea_room_id_foreign')
                  ->references('room_id')->on('rooms');
            $table->foreign('examinee_id', 'eea_examinee_id_foreign')
                  ->references('user_id')->on('users');
            $table->foreign('exam_id', 'eea_exam_id_foreign')
                  ->references('exam_id')->on('exams');
            
            $table->primary(['room_id', 'examinee_id', 'exam_id', 'attempt_at'], 'eea_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examinee_exam_attempts');
    }
}
