<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamTextsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_texts_audit', function (Blueprint $table) {
            $table->id('exam_texts_audit_id');
            
            $table->bigInteger('modified_by')->unsigned()->default(0);
            $table->timestamp('modified_at')->useCurrent();
            $table->char('operation', 1);

            $table->bigInteger('exam_id')->unsigned();
            $table->bigInteger('section_no')->unsigned();
            $table->bigInteger('item_no')->unsigned();

            $table->longText('text');
            $table->bigInteger('before_item_no')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_texts_audit');
    }
}
