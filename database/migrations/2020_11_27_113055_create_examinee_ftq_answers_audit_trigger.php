<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamineeFtqAnswersAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_examinee_ftq_answers_audit_insert
            AFTER INSERT
            ON examinee_ftq_answers FOR EACH ROW
                BEGIN
                    INSERT INTO examinee_ftq_answers_audit (
                        modified_by,
                        modified_at,
                        operation,
                        answer_id,
                        answer,
                        is_correct
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.answer_id,
                        NEW.answer,
                        NEW.is_correct
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_examinee_ftq_answers_audit_delete
            AFTER DELETE
            ON examinee_ftq_answers FOR EACH ROW
                BEGIN
                    INSERT INTO examinee_ftq_answers_audit (
                        modified_by,
                        modified_at,
                        operation,
                        answer_id,
                        answer,
                        is_correct
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.answer_id,
                        OLD.answer,
                        OLD.is_correct
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_examinee_ftq_answers_audit_update
            AFTER UPDATE
            ON examinee_ftq_answers FOR EACH ROW
                BEGIN
                    INSERT INTO examinee_ftq_answers_audit (
                        modified_by,
                        modified_at,
                        operation,
                        answer_id,
                        answer,
                        is_correct
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.answer_id,
                        NEW.answer,
                        NEW.is_correct
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
        Schema::dropIfExists('examinee_ftq_answers_audit_trigger');
    }
}
