<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id('question_id');
            $table->bigInteger('exam_id')->unsigned();
            $table->bigInteger('section_no')->unsigned();
            $table->bigInteger('item_no')->unsigned();
            $table->bigInteger('question_no')->unsigned();
            $table->bigInteger('question_type_id')->unsigned();

            $table->longText('question');
            $table->double('total_points', 10, 2)->default(0.00);
            
            $table->bigInteger('created_by')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('updated_by')->default(0);
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('exam_id')
                  ->references('exam_id')->on('exams');
            $table->foreign('question_type_id')
                  ->references('question_type_id')->on('question_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
