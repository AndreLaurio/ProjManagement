<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnumerationQuestionElementsAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_enumeration_question_elements_audit_insert
            AFTER INSERT
            ON enumeration_question_elements FOR EACH ROW
                BEGIN
                    INSERT INTO enumeration_question_elements_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_id,
                        element_no,
                        element
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.question_id,
                        NEW.element_no,
                        NEW.element
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_enumeration_question_elements_audit_delete
            AFTER DELETE
            ON enumeration_question_elements FOR EACH ROW
                BEGIN
                    INSERT INTO enumeration_question_elements_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_id,
                        element_no,
                        element
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.question_id,
                        OLD.element_no,
                        OLD.element
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_enumeration_question_elements_audit_update
            AFTER UPDATE
            ON enumeration_question_elements FOR EACH ROW
                BEGIN
                    INSERT INTO enumeration_question_elements_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_id,
                        element_no,
                        element
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.question_id,
                        NEW.element_no,
                        NEW.element
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
        Schema::dropIfExists('enumeration_question_elements_audit_trigger');
    }
}
