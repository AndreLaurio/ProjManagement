<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_sections', function (Blueprint $table) {
            $table->bigInteger('exam_id')->unsigned();
            $table->bigInteger('section_no')->unsigned();

            $table->string('section_title', 100);
            $table->longText('section_desc')->nullable();
            $table->double('total_points', 10, 2)->default(0.00);
            $table->boolean('shuffle_questions')->default(false);
            
            $table->bigInteger('created_by')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('updated_by')->default(0);
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('exam_id')
                  ->references('exam_id')->on('exams');

            $table->primary(['exam_id', 'section_no']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_sections');
    }
}
