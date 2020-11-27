<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnumerationQuestionsAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_enumeration_questions_audit_insert
            AFTER INSERT
            ON enumeration_questions FOR EACH ROW
                BEGIN
                    INSERT INTO enumeration_questions_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_id,
                        no_of_elements,
                        in_order,
                        case_insensitive,
                        points,
                        is_points_per_elements
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.question_id,
                        NEW.no_of_elements,
                        NEW.in_order,
                        NEW.case_insensitive,
                        NEW.points,
                        NEW.is_points_per_elements
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_enumeration_questions_audit_delete
            AFTER DELETE
            ON enumeration_questions FOR EACH ROW
                BEGIN
                    INSERT INTO enumeration_questions_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_id,
                        no_of_elements,
                        in_order,
                        case_insensitive,
                        points,
                        is_points_per_elements
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.question_id,
                        OLD.no_of_elements,
                        OLD.in_order,
                        OLD.case_insensitive,
                        OLD.points,
                        OLD.is_points_per_elements
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_enumeration_questions_audit_update
            AFTER UPDATE
            ON enumeration_questions FOR EACH ROW
                BEGIN
                    INSERT INTO enumeration_questions_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_id,
                        no_of_elements,
                        in_order,
                        case_insensitive,
                        points,
                        is_points_per_elements
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.question_id,
                        NEW.no_of_elements,
                        NEW.in_order,
                        NEW.case_insensitive,
                        NEW.points,
                        NEW.is_points_per_elements
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
        Schema::dropIfExists('enumeration_questions_audit_trigger');
    }
}
