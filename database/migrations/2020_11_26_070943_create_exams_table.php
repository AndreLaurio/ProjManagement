<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id('exam_id');
            $table->bigInteger('examiner_id')->unsigned();
            $table->string('exam_code', 10)->unique();

            $table->string('exam_title', 100);
            $table->longText('exam_desc')->nullable();
            $table->double('total_points', 10, 2)->default(0.00);
            $table->double('passing_percentage', 5, 2)->default(0.00);
            $table->boolean('is_student_review_enabled')->default(true);
            $table->boolean('is_monitoring_switching_tab_enabled')->default(false);
            
            $table->bigInteger('created_by')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('updated_by')->default(0);
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('examiner_id')
                  ->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
