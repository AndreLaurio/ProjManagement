<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamineeAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinee_answers', function (Blueprint $table) {
            $table->id('answer_id');
            $table->bigInteger('room_id')->unsigned();
            $table->bigInteger('examinee_id')->unsigned();
            $table->bigInteger('exam_id')->unsigned();
            $table->bigInteger('question_id')->unsigned();

            $table->double('total_score', 10, 2)->default(0.00);
            
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
            $table->foreign('question_id')
                  ->references('exam_id')->on('exams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examinee_answers');
    }
}
