<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamineeExamMonitoringAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_examinee_exam_monitoring_audit_insert
            AFTER INSERT
            ON examinee_exam_monitoring FOR EACH ROW
                BEGIN
                    INSERT INTO examinee_exam_monitoring_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        examinee_id,
                        exam_id,
                        switched_at
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.room_id,
                        NEW.examinee_id,
                        NEW.exam_id,
                        NEW.switched_at
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_examinee_exam_monitoring_audit_delete
            AFTER DELETE
            ON examinee_exam_monitoring FOR EACH ROW
                BEGIN
                    INSERT INTO examinee_exam_monitoring_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        examinee_id,
                        exam_id,
                        switched_at
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.room_id,
                        OLD.examinee_id,
                        OLD.exam_id,
                        OLD.switched_at
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_examinee_exam_monitoring_audit_update
            AFTER UPDATE
            ON examinee_exam_monitoring FOR EACH ROW
                BEGIN
                    INSERT INTO examinee_exam_monitoring_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        examinee_id,
                        exam_id,
                        switched_at
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.room_id,
                        NEW.examinee_id,
                        NEW.exam_id,
                        NEW.switched_at
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
        Schema::dropIfExists('examinee_exam_monitoring_audit_trigger');
    }
}
