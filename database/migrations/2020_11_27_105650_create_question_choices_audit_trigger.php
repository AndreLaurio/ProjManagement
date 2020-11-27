<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionChoicesAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_question_choices_audit_insert
            AFTER INSERT
            ON question_choices FOR EACH ROW
                BEGIN
                    INSERT INTO question_choices_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_id,
                        choice_no,
                        choice,
                        is_correct
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.question_id,
                        NEW.choice_no,
                        NEW.choice,
                        NEW.is_correct
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_question_choices_audit_delete
            AFTER DELETE
            ON question_choices FOR EACH ROW
                BEGIN
                    INSERT INTO question_choices_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_id,
                        choice_no,
                        choice,
                        is_correct
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.question_id,
                        OLD.choice_no,
                        OLD.choice,
                        OLD.is_correct
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_question_choices_audit_update
            AFTER UPDATE
            ON question_choices FOR EACH ROW
                BEGIN
                    INSERT INTO question_choices_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_id,
                        choice_no,
                        choice,
                        is_correct
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.question_id,
                        NEW.choice_no,
                        NEW.choice,
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
        Schema::dropIfExists('question_choices_audit_trigger');
    }
}
