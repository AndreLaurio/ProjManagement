<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhoneTypesAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_types_audit', function (Blueprint $table) {
            $table->id('phone_types_audit_id');
            
            $table->bigInteger('modified_by')->unsigned()->default(0);
            $table->timestamp('modified_at')->useCurrent();
            $table->char('operation', 1);

            $table->bigInteger('phone_type_id')->unsigned();
            $table->string('phone_type', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phone_types_audit');
    }
}
