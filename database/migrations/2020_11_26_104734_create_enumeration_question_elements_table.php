<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnumerationQuestionElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enumeration_question_elements', function (Blueprint $table) {
            $table->bigInteger('question_id')->unsigned();
            $table->bigInteger('element_no')->unsigned();
            
            $table->longText('element');
            
            $table->bigInteger('created_by')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('updated_by')->default(0);
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('question_id')
                  ->references('question_id')->on('questions');
            
            $table->primary(['question_id', 'element_no']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enumeration_question_elements');
    }
}
