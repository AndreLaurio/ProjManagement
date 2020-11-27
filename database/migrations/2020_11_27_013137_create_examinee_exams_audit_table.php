<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamineeExamsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinee_exams_audit', function (Blueprint $table) {
            $table->id('examinee_exams_audit_id');
            
            $table->bigInteger('modified_by')->unsigned()->default(0);
            $table->timestamp('modified_at')->useCurrent();
            $table->char('operation', 1);

            $table->bigInteger('room_id')->unsigned();
            $table->bigInteger('examinee_id')->unsigned();
            $table->bigInteger('exam_id')->unsigned();
            $table->string('result_status_code', 5);

            $table->integer('no_of_attempts')->default(0);
            $table->boolean('total_score', 10, 2)->default(0.00);
            $table->boolean('total_percentage', 5, 2)->default(0.00);
            $table->integer('switching_tab_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examinee_exams_audit');
    }
}
