<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultipleChoiceQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiple_choice_questions', function (Blueprint $table) {
            $table->bigInteger('question_id')->unsigned();
            $table->bigInteger('mcq_probability_id')->unsigned();
            
            $table->integer('select_count')->default(1);
            $table->double('points', 10, 2)->default(0.00);
            $table->boolean('is_points_per_choice')->default(false);
            $table->boolean('shuffle_choices')->default(false);
            
            $table->bigInteger('created_by')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('updated_by')->default(0);
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('question_id')
                  ->references('question_id')->on('questions');
            $table->foreign('mcq_probability_id')
                  ->references('mcq_probability_id')->on('mcq_probabilities');
                
            $table->primary('question_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multiple_choice_questions');
    }
}
