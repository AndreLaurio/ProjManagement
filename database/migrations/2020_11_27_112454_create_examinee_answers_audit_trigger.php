<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamineeAnswersAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_examinee_answers_audit_insert
            AFTER INSERT
            ON examinee_answers FOR EACH ROW
                BEGIN
                    INSERT INTO examinee_answers_audit (
                        modified_by,
                        modified_at,
                        operation,
                        answer_id,
                        room_id,
                        examinee_id,
                        exam_id,
                        question_id,
                        total_score
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.answer_id,
                        NEW.room_id,
                        NEW.examinee_id,
                        NEW.exam_id,
                        NEW.question_id,
                        NEW.total_score
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_examinee_answers_audit_delete
            AFTER DELETE
            ON examinee_answers FOR EACH ROW
                BEGIN
                    INSERT INTO examinee_answers_audit (
                        modified_by,
                        modified_at,
                        operation,
                        answer_id,
                        room_id,
                        examinee_id,
                        exam_id,
                        question_id,
                        total_score
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.answer_id,
                        OLD.room_id,
                        OLD.examinee_id,
                        OLD.exam_id,
                        OLD.question_id,
                        OLD.total_score
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_examinee_answers_audit_update
            AFTER UPDATE
            ON examinee_answers FOR EACH ROW
                BEGIN
                    INSERT INTO examinee_answers_audit (
                        modified_by,
                        modified_at,
                        operation,
                        answer_id,
                        room_id,
                        examinee_id,
                        exam_id,
                        question_id,
                        total_score
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.answer_id,
                        NEW.room_id,
                        NEW.examinee_id,
                        NEW.exam_id,
                        NEW.question_id,
                        NEW.total_score
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
        Schema::dropIfExists('examinee_answers_audit_trigger');
    }
}
