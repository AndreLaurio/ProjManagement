<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnumerationQuestionsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enumeration_questions_audit', function (Blueprint $table) {
            $table->id('enumeration_questions_audit_id');
            
            $table->bigInteger('modified_by')->unsigned()->default(0);
            $table->timestamp('modified_at')->useCurrent();
            $table->char('operation', 1);

            $table->bigInteger('question_id')->unsigned();
            
            $table->integer('no_of_elements')->default(0);
            $table->boolean('in_order')->default(false);
            $table->boolean('case_insensitive')->default(false);
            $table->double('points', 10, 2)->default(0.00);
            $table->boolean('is_points_per_elements')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enumeration_questions_audit');
    }
}
