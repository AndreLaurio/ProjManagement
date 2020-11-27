<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultStatusAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_result_status_audit_insert
            AFTER INSERT
            ON result_status FOR EACH ROW
                BEGIN
                    INSERT INTO result_status_audit (
                        modified_by,
                        modified_at,
                        operation,
                        result_status_code,
                        result_status
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.result_status_code,
                        NEW.result_status
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_result_status_audit_delete
            AFTER DELETE
            ON result_status FOR EACH ROW
                BEGIN
                    INSERT INTO result_status_audit (
                        modified_by,
                        modified_at,
                        operation,
                        result_status_code,
                        result_status
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.result_status_code,
                        OLD.result_status
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_result_status_audit_update
            AFTER UPDATE
            ON result_status FOR EACH ROW
                BEGIN
                    INSERT INTO result_status_audit (
                        modified_by,
                        modified_at,
                        operation,
                        result_status_code,
                        result_status
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.result_status_code,
                        NEW.result_status
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
        Schema::dropIfExists('result_status_audit_trigger');
    }
}
