<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_items', function (Blueprint $table) {
            $table->bigInteger('exam_id')->unsigned();
            $table->bigInteger('section_no')->unsigned();
            $table->bigInteger('item_no')->unsigned();
            $table->bigInteger('item_type_id')->unsigned();
            
            $table->bigInteger('created_by')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('updated_by')->default(0);
            $table->timestamp('updated_at')->useCurrent();
            
            $table->foreign('exam_id')
                  ->references('exam_id')->on('exams');
            $table->foreign('item_type_id')
                  ->references('item_type_id')->on('item_types');

            $table->primary(['exam_id', 'section_no', 'item_no']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_items');
    }
}
