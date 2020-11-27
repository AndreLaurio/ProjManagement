<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamSectionsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_sections_audit', function (Blueprint $table) {
            $table->id('exam_sections_audit_id');
            
            $table->bigInteger('modified_by')->unsigned()->default(0);
            $table->timestamp('modified_at')->useCurrent();
            $table->char('operation', 1);

            $table->bigInteger('exam_id')->unsigned();
            $table->bigInteger('section_no')->unsigned();

            $table->string('section_title', 100);
            $table->longText('section_desc')->nullable();
            $table->double('total_points', 10, 2)->default(0.00);
            $table->boolean('shuffle_questions')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_sections_audit');
    }
}
