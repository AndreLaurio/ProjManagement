<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms_audit', function (Blueprint $table) {
            $table->id('rooms_audit_id');
            
            $table->bigInteger('modified_by')->unsigned()->default(0);
            $table->timestamp('modified_at')->useCurrent();
            $table->char('operation', 1);

            $table->bigInteger('room_id')->unsigned();
            $table->bigInteger('examiner_id')->unsigned();
            $table->string('room_code', 8);

            $table->string('room_title', 100);
            $table->longText('room_desc')->nullable();
            $table->integer('total_examinees')->default(0);
            $table->integer('total_exams')->default(0);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms_audit');
    }
}
