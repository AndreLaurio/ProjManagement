<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultipleChoiceQuestionsAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_multiple_choice_questions_audit_insert
            AFTER INSERT
            ON multiple_choice_questions FOR EACH ROW
                BEGIN
                    INSERT INTO multiple_choice_questions_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_id,
                        mcq_probability_id,
                        select_count,
                        points,
                        is_points_per_choice,
                        shuffle_choices
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.question_id,
                        NEW.mcq_probability_id,
                        NEW.select_count,
                        NEW.points,
                        NEW.is_points_per_choice,
                        NEW.shuffle_choices
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_multiple_choice_questions_audit_delete
            AFTER DELETE
            ON multiple_choice_questions FOR EACH ROW
                BEGIN
                    INSERT INTO multiple_choice_questions_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_id,
                        mcq_probability_id,
                        select_count,
                        points,
                        is_points_per_choice,
                        shuffle_choices
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.question_id,
                        OLD.mcq_probability_id,
                        OLD.select_count,
                        OLD.points,
                        OLD.is_points_per_choice,
                        OLD.shuffle_choices
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_multiple_choice_questions_audit_update
            AFTER UPDATE
            ON multiple_choice_questions FOR EACH ROW
                BEGIN
                    INSERT INTO multiple_choice_questions_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_id,
                        mcq_probability_id,
                        select_count,
                        points,
                        is_points_per_choice,
                        shuffle_choices
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.question_id,
                        NEW.mcq_probability_id,
                        NEW.select_count,
                        NEW.points,
                        NEW.is_points_per_choice,
                        NEW.shuffle_choices
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
        Schema::dropIfExists('multiple_choice_questions_audit_trigger');
    }
}
