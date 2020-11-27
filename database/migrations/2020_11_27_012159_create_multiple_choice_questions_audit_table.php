<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultipleChoiceQuestionsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiple_choice_questions_audit', function (Blueprint $table) {
            $table->id('multiple_choice_questions_audit_id');
            
            $table->bigInteger('modified_by')->unsigned()->default(0);
            $table->timestamp('modified_at')->useCurrent();
            $table->char('operation', 1);

            $table->bigInteger('question_id')->unsigned();
            $table->bigInteger('mcq_probability_id')->unsigned();
            
            $table->integer('select_count')->default(1);
            $table->double('points', 10, 2)->default(0.00);
            $table->boolean('is_points_per_choice')->default(false);
            $table->boolean('shuffle_choices')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multiple_choice_questions_audit');
    }
}
