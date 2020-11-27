<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamineeEnuAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinee_enu_answers', function (Blueprint $table) {
            $table->bigInteger('answer_id')->unsigned();
            $table->bigInteger('element_no')->unsigned();

            $table->longText('answer');
            $table->boolean('is_correct')->default(false);
            
            $table->bigInteger('created_by')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('updated_by')->default(0);
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('answer_id')
                  ->references('answer_id')->on('examinee_answers');
            
            $table->primary(['answer_id', 'element_no']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examinee_enu_answers');
    }
}
