<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_exams_audit_insert
            AFTER INSERT
            ON exams FOR EACH ROW
                BEGIN
                    INSERT INTO exams_audit (
                        modified_by,
                        modified_at,
                        operation,
                        exam_id,
                        examiner_id,
                        exam_code,
                        exam_title,
                        exam_desc,
                        total_points,
                        passing_percentage,
                        is_student_review_enabled,
                        is_monitoring_switching_tab_enabled
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.exam_id,
                        NEW.examiner_id,
                        NEW.exam_code,
                        NEW.exam_title,
                        NEW.exam_desc,
                        NEW.total_points,
                        NEW.passing_percentage,
                        NEW.is_student_review_enabled,
                        NEW.is_monitoring_switching_tab_enabled
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_exams_audit_delete
            AFTER DELETE
            ON exams FOR EACH ROW
                BEGIN
                    INSERT INTO exams_audit (
                        modified_by,
                        modified_at,
                        operation,
                        exam_id,
                        examiner_id,
                        exam_code,
                        exam_title,
                        exam_desc,
                        total_points,
                        passing_percentage,
                        is_student_review_enabled,
                        is_monitoring_switching_tab_enabled
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.exam_id,
                        OLD.examiner_id,
                        OLD.exam_code,
                        OLD.exam_title,
                        OLD.exam_desc,
                        OLD.total_points,
                        OLD.passing_percentage,
                        OLD.is_student_review_enabled,
                        OLD.is_monitoring_switching_tab_enabled
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_exams_audit_update
            AFTER UPDATE
            ON exams FOR EACH ROW
                BEGIN
                    INSERT INTO exams_audit (
                        modified_by,
                        modified_at,
                        operation,
                        exam_id,
                        examiner_id,
                        exam_code,
                        exam_title,
                        exam_desc,
                        total_points,
                        passing_percentage,
                        is_student_review_enabled,
                        is_monitoring_switching_tab_enabled
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.exam_id,
                        NEW.examiner_id,
                        NEW.exam_code,
                        NEW.exam_title,
                        NEW.exam_desc,
                        NEW.total_points,
                        NEW.passing_percentage,
                        NEW.is_student_review_enabled,
                        NEW.is_monitoring_switching_tab_enabled
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
        Schema::dropIfExists('exams_audit_trigger');
    }
}
