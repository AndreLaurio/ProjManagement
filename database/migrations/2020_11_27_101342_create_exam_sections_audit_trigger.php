<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamSectionsAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_exam_sections_audit_insert
            AFTER INSERT
            ON exam_sections FOR EACH ROW
                BEGIN
                    INSERT INTO exam_sections_audit (
                        modified_by,
                        modified_at,
                        operation,
                        exam_id,
                        section_no,
                        section_title,
                        section_desc,
                        total_points,
                        shuffle_questions
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.exam_id,
                        NEW.section_no,
                        NEW.section_title,
                        NEW.section_desc,
                        NEW.total_points,
                        NEW.shuffle_questions
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_exam_sections_audit_delete
            AFTER DELETE
            ON exam_sections FOR EACH ROW
                BEGIN
                    INSERT INTO exam_sections_audit (
                        modified_by,
                        modified_at,
                        operation,
                        exam_id,
                        section_no,
                        section_title,
                        section_desc,
                        total_points,
                        shuffle_questions
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.exam_id,
                        OLD.section_no,
                        OLD.section_title,
                        OLD.section_desc,
                        OLD.total_points,
                        OLD.shuffle_questions
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_exam_sections_audit_update
            AFTER UPDATE
            ON exam_sections FOR EACH ROW
                BEGIN
                    INSERT INTO exam_sections_audit (
                        modified_by,
                        modified_at,
                        operation,
                        exam_id,
                        section_no,
                        section_title,
                        section_desc,
                        total_points,
                        shuffle_questions
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.exam_id,
                        NEW.section_no,
                        NEW.section_title,
                        NEW.section_desc,
                        NEW.total_points,
                        NEW.shuffle_questions
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
        Schema::dropIfExists('exam_sections_audit_trigger');
    }
}
