<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypesAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        DB::unprepared("
            CREATE TRIGGER tr_user_types_audit_insert
            AFTER INSERT
            ON user_types FOR EACH ROW
                BEGIN
                    INSERT INTO user_types_audit (
                        modified_by,
                        modified_at,
                        operation,
                        user_type_id,
                        user_type
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.user_type_id,
                        NEW.user_type
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_user_types_audit_delete
            AFTER DELETE
            ON user_types FOR EACH ROW
                BEGIN
                    INSERT INTO user_types_audit (
                        modified_by,
                        modified_at,
                        operation,
                        user_type_id,
                        user_type
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.user_type_id,
                        OLD.user_type
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_user_types_audit_update
            AFTER UPDATE
            ON user_types FOR EACH ROW
                BEGIN
                    INSERT INTO user_types_audit (
                        modified_by,
                        modified_at,
                        operation,
                        user_type_id,
                        user_type
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.user_type_id,
                        NEW.user_type
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
        Schema::dropIfExists('user_types_audit_trigger');
    }
}
