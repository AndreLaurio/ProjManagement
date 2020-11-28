<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams_audit', function (Blueprint $table) {
            $table->id('exams_audit_id');
            
            $table->bigInteger('modified_by')->unsigned()->default(0);
            $table->timestamp('modified_at')->useCurrent();
            $table->char('operation', 1);

            $table->bigInteger('exam_id')->unsigned();
            $table->bigInteger('examiner_id')->unsigned();
            $table->string('exam_code', 10);

            $table->string('exam_title', 100);
            $table->longText('exam_desc')->nullable();
            $table->double('total_points', 10, 2)->default(0.00);
            $table->double('passing_percentage', 5, 2)->default(0.00);
            $table->boolean('is_examinee_review_enabled')->default(true);
            $table->boolean('is_monitoring_switching_tab_enabled')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams_audit');
    }
}
