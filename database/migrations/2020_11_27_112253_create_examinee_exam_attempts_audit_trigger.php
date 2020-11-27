<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamineeExamAttemptsAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_examinee_exam_attempts_audit_insert
            AFTER INSERT
            ON examinee_exam_attempts FOR EACH ROW
                BEGIN
                    INSERT INTO examinee_exam_attempts_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        examinee_id,
                        exam_id,
                        attempt_at,
                        attempt_ip,
                        attempt_device
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.room_id,
                        NEW.examinee_id,
                        NEW.exam_id,
                        NEW.attempt_at,
                        NEW.attempt_ip,
                        NEW.attempt_device
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_examinee_exam_attempts_audit_delete
            AFTER DELETE
            ON examinee_exam_attempts FOR EACH ROW
                BEGIN
                    INSERT INTO examinee_exam_attempts_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        examinee_id,
                        exam_id,
                        attempt_at,
                        attempt_ip,
                        attempt_device
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.room_id,
                        OLD.examinee_id,
                        OLD.exam_id,
                        OLD.attempt_at,
                        OLD.attempt_ip,
                        OLD.attempt_device
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_examinee_exam_attempts_audit_update
            AFTER UPDATE
            ON examinee_exam_attempts FOR EACH ROW
                BEGIN
                    INSERT INTO examinee_exam_attempts_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        examinee_id,
                        exam_id,
                        attempt_at,
                        attempt_ip,
                        attempt_device
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.room_id,
                        NEW.examinee_id,
                        NEW.exam_id,
                        NEW.attempt_at,
                        NEW.attempt_ip,
                        NEW.attempt_device
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
        Schema::dropIfExists('examinee_exam_attempts_audit_trigger');
    }
}
