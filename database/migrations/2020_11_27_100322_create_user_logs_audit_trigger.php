<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLogsAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_user_logs_audit_insert
            AFTER INSERT
            ON user_logs FOR EACH ROW
                BEGIN
                    INSERT INTO user_logs_audit (
                        modified_by,
                        modified_at,
                        operation,
                        user_id,
                        log_type_id,
                        logged_at
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.user_id,
                        NEW.log_type_id,
                        NEW.logged_at
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_user_logs_audit_delete
            AFTER DELETE
            ON user_logs FOR EACH ROW
                BEGIN
                    INSERT INTO user_logs_audit (
                        modified_by,
                        modified_at,
                        operation,
                        user_id,
                        log_type_id,
                        logged_at
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.user_id,
                        OLD.log_type_id,
                        OLD.logged_at
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_user_logs_audit_update
            AFTER UPDATE
            ON user_logs FOR EACH ROW
                BEGIN
                    INSERT INTO user_logs_audit (
                        modified_by,
                        modified_at,
                        operation,
                        user_id,
                        log_type_id,
                        logged_at
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.user_id,
                        NEW.log_type_id,
                        NEW.logged_at
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
        Schema::dropIfExists('user_logs_audit_trigger');
    }
}
