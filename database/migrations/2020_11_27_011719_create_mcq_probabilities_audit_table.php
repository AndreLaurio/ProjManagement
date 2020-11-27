<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcqProbabilitiesAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcq_probabilities_audit', function (Blueprint $table) {
            $table->id('mcq_probabilities_audit_id');
            
            $table->bigInteger('modified_by')->unsigned()->default(0);
            $table->timestamp('modified_at')->useCurrent();
            $table->char('operation', 1);

            $table->bigInteger('mcq_probability_id')->unsigned();
            $table->string('mcq_probability', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mcq_probabilities_audit');
    }
}
