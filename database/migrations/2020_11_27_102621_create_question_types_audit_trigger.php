<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionTypesAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_question_types_audit_insert
            AFTER INSERT
            ON question_types FOR EACH ROW
                BEGIN
                    INSERT INTO question_types_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_type_id,
                        question_type
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.question_type_id,
                        NEW.question_type
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_question_types_audit_delete
            AFTER DELETE
            ON question_types FOR EACH ROW
                BEGIN
                    INSERT INTO question_types_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_type_id,
                        question_type
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.question_type_id,
                        OLD.question_type
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_question_types_audit_update
            AFTER UPDATE
            ON question_types FOR EACH ROW
                BEGIN
                    INSERT INTO question_types_audit (
                        modified_by,
                        modified_at,
                        operation,
                        question_type_id,
                        question_type
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.question_type_id,
                        NEW.question_type
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
        Schema::dropIfExists('question_types_audit_trigger');
    }
}
