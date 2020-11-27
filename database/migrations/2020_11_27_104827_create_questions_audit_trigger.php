<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_questions_audit_insert
            AFTER INSERT
            ON questions FOR EACH ROW
                BEGIN
                    INSERT INTO questions_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_id,
                        exam_id,
                        section_no,
                        item_no,
                        question_type_id,
                        question,
                        total_points
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.question_id,
                        NEW.exam_id,
                        NEW.section_no,
                        NEW.item_no,
                        NEW.question_type_id,
                        NEW.question,
                        NEW.total_points
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_questions_audit_delete
            AFTER DELETE
            ON questions FOR EACH ROW
                BEGIN
                    INSERT INTO questions_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_id,
                        exam_id,
                        section_no,
                        item_no,
                        question_type_id,
                        question,
                        total_points
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.question_id,
                        OLD.exam_id,
                        OLD.section_no,
                        OLD.item_no,
                        OLD.question_type_id,
                        OLD.question,
                        OLD.total_points
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_questions_audit_update
            AFTER UPDATE
            ON questions FOR EACH ROW
                BEGIN
                    INSERT INTO questions_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_id,
                        exam_id,
                        section_no,
                        item_no,
                        question_type_id,
                        question,
                        total_points
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.question_id,
                        NEW.exam_id,
                        NEW.section_no,
                        NEW.item_no,
                        NEW.question_type_id,
                        NEW.question,
                        NEW.total_points
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
        Schema::dropIfExists('questions_audit_trigger');
    }
}
