<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamineeExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinee_exams', function (Blueprint $table) {
            $table->bigInteger('room_id')->unsigned();
            $table->bigInteger('examinee_id')->unsigned();
            $table->bigInteger('exam_id')->unsigned();
            $table->string('result_status_code', 5);

            $table->integer('no_of_attempts')->default(0);
            $table->boolean('total_score', 10, 2)->default(0.00);
            $table->boolean('total_percentage', 5, 2)->default(0.00);
            $table->integer('switching_tab_count')->default(0);
            
            $table->bigInteger('created_by')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('updated_by')->default(0);
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('room_id')
                  ->references('room_id')->on('rooms');
            $table->foreign('examinee_id')
                  ->references('user_id')->on('users');
            $table->foreign('exam_id')
                  ->references('exam_id')->on('exams');
            $table->foreign('result_status_code')
                ->references('result_status_code')->on('result_status');
            
            $table->primary(['room_id', 'examinee_id', 'exam_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examinee_exams');
    }
}
