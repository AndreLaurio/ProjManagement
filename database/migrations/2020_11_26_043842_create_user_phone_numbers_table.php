<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPhoneNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_phone_numbers', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('phone_type_id')->unsigned();
            $table->string('phone_number', 50);
            
            $table->bigInteger('created_by')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('updated_by')->default(0);
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('user_id')
                  ->references('user_id')->on('users');
            $table->foreign('phone_type_id')
                  ->references('phone_type_id')->on('phone_types');
            
            $table->primary(['user_id', 'phone_type_id', 'phone_number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_phone_numbers');
    }
}
