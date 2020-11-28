<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamineeExamsAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_examinee_exams_audit_insert
            AFTER INSERT
            ON examinee_exams FOR EACH ROW
                BEGIN
                    INSERT INTO examinee_exams_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        examinee_id,
                        exam_id,
                        result_status_code,
                        no_of_attempts,
                        total_score,
                        total_percentage,
                        switching_tab_count,
                        started_at,
                        finished_at
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.room_id,
                        NEW.examinee_id,
                        NEW.exam_id,
                        NEW.result_status_code,
                        NEW.no_of_attempts,
                        NEW.total_score,
                        NEW.total_percentage,
                        NEW.switching_tab_count,
                        NEW.started_at,
                        NEW.finished_at
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_examinee_exams_audit_delete
            AFTER DELETE
            ON examinee_exams FOR EACH ROW
                BEGIN
                    INSERT INTO examinee_exams_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        examinee_id,
                        exam_id,
                        result_status_code,
                        no_of_attempts,
                        total_score,
                        total_percentage,
                        switching_tab_count,
                        started_at,
                        finished_at
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.room_id,
                        OLD.examinee_id,
                        OLD.exam_id,
                        OLD.result_status_code,
                        OLD.no_of_attempts,
                        OLD.total_score,
                        OLD.total_percentage,
                        OLD.switching_tab_count,
                        OLD.started_at,
                        OLD.finished_at
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_examinee_exams_audit_update
            AFTER UPDATE
            ON examinee_exams FOR EACH ROW
                BEGIN
                    INSERT INTO examinee_exams_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        examinee_id,
                        exam_id,
                        result_status_code,
                        no_of_attempts,
                        total_score,
                        total_percentage,
                        switching_tab_count,
                        started_at,
                        finished_at
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.room_id,
                        NEW.examinee_id,
                        NEW.exam_id,
                        NEW.result_status_code,
                        NEW.no_of_attempts,
                        NEW.total_score,
                        NEW.total_percentage,
                        NEW.switching_tab_count,
                        NEW.started_at,
                        NEW.finished_at
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
        Schema::dropIfExists('examinee_exams_audit_trigger');
    }
}
