<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_audit', function (Blueprint $table) {
            $table->id('questions_audit_id');
            
            $table->bigInteger('modified_by')->unsigned()->default(0);
            $table->timestamp('modified_at')->useCurrent();
            $table->char('operation', 1);

            $table->bigInteger('question_id')->unsigned();
            $table->bigInteger('exam_id')->unsigned();
            $table->bigInteger('section_no')->unsigned();
            $table->bigInteger('item_no')->unsigned();
            $table->bigInteger('question_no')->unsigned();
            $table->bigInteger('question_type_id')->unsigned();

            $table->longText('question');
            $table->double('total_points', 10, 2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions_audit');
    }
}
