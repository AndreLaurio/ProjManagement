<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhoneTypesAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_phone_types_audit_insert
            AFTER INSERT
            ON phone_types FOR EACH ROW
                BEGIN
                    INSERT INTO phone_types_audit (
                        modified_by,
                        modified_at,
                        operation,
                        phone_type_id,
                        phone_type
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.phone_type_id,
                        NEW.phone_type
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_phone_types_audit_delete
            AFTER DELETE
            ON phone_types FOR EACH ROW
                BEGIN
                    INSERT INTO phone_types_audit (
                        modified_by,
                        modified_at,
                        operation,
                        phone_type_id,
                        phone_type
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.phone_type_id,
                        OLD.phone_type
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_phone_types_audit_update
            AFTER UPDATE
            ON phone_types FOR EACH ROW
                BEGIN
                    INSERT INTO phone_types_audit (
                        modified_by,
                        modified_at,
                        operation,
                        phone_type_id,
                        phone_type
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.phone_type_id,
                        NEW.phone_type
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
        Schema::dropIfExists('phone_types_audit_trigger');
    }
}
