<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnumerationQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enumeration_questions', function (Blueprint $table) {
            $table->bigInteger('question_id')->unsigned();
            
            $table->integer('no_of_elements')->default(0);
            $table->boolean('in_order')->default(false);
            $table->boolean('case_insensitive')->default(false);
            $table->double('points', 10, 2)->default(0.00);
            $table->boolean('is_points_per_elements')->default(false);
            
            $table->bigInteger('created_by')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('updated_by')->default(0);
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('question_id')
                  ->references('question_id')->on('questions');
                
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
        Schema::dropIfExists('enumeration_questions');
    }
}
