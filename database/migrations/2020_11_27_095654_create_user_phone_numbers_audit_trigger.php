<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPhoneNumbersAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_user_phone_numbers_audit_insert
            AFTER INSERT
            ON user_phone_numbers FOR EACH ROW
                BEGIN
                    INSERT INTO user_phone_numbers_audit (
                        modified_by,
                        modified_at,
                        operation,
                        user_id,
                        phone_type_id,
                        phone_number
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.user_id,
                        NEW.phone_type_id,
                        NEW.phone_number
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_user_phone_numbers_audit_delete
            AFTER DELETE
            ON user_phone_numbers FOR EACH ROW
                BEGIN
                    INSERT INTO user_phone_numbers_audit (
                        modified_by,
                        modified_at,
                        operation,
                        user_id,
                        phone_type_id,
                        phone_number
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.user_id,
                        OLD.phone_type_id,
                        OLD.phone_number
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_user_phone_numbers_audit_update
            AFTER UPDATE
            ON user_phone_numbers FOR EACH ROW
                BEGIN
                    INSERT INTO user_phone_numbers_audit (
                        modified_by,
                        modified_at,
                        operation,
                        user_id,
                        phone_type_id,
                        phone_number
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.user_id,
                        NEW.phone_type_id,
                        NEW.phone_number
                    );
                END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_phone_numbers_audit_trigger');
    }
}
