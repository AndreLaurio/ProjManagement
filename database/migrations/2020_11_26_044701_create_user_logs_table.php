<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_logs', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('log_type_id')->unsigned();
            $table->timestamp('logged_at')->useCurrent();
            
            $table->bigInteger('created_by')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('updated_by')->default(0);
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('user_id')
                  ->references('user_id')->on('users');
            $table->foreign('log_type_id')
                  ->references('log_type_id')->on('log_types');

            $table->primary(['user_id', 'log_type_id', 'logged_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_logs');
    }
}
