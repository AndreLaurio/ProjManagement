<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogTypesAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_log_types_audit_insert
            AFTER INSERT
            ON log_types FOR EACH ROW
                BEGIN
                    INSERT INTO log_types_audit (
                        modified_by,
                        modified_at,
                        operation,
                        log_type_id,
                        log_type
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.log_type_id,
                        NEW.log_type
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_log_types_audit_delete
            AFTER DELETE
            ON log_types FOR EACH ROW
                BEGIN
                    INSERT INTO log_types_audit (
                        modified_by,
                        modified_at,
                        operation,
                        log_type_id,
                        log_type
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.log_type_id,
                        OLD.log_type
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_log_types_audit_update
            AFTER UPDATE
            ON log_types FOR EACH ROW
                BEGIN
                    INSERT INTO log_types_audit (
                        modified_by,
                        modified_at,
                        operation,
                        log_type_id,
                        log_type
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.log_type_id,
                        NEW.log_type
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
        Schema::dropIfExists('log_types_audit_trigger');
    }
}
