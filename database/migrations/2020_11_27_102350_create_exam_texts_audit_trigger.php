<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamTextsAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_exam_texts_audit_insert
            AFTER INSERT
            ON exam_texts FOR EACH ROW
                BEGIN
                    INSERT INTO exam_texts_audit (
                        modified_by,
                        modified_at,
                        operation,
                        exam_id,
                        section_no,
                        item_no,
                        text,
                        before_item_no
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.exam_id,
                        NEW.section_no,
                        NEW.item_no,
                        NEW.text,
                        NEW.before_item_no
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_exam_texts_audit_delete
            AFTER DELETE
            ON exam_texts FOR EACH ROW
                BEGIN
                    INSERT INTO exam_texts_audit (
                        modified_by,
                        modified_at,
                        operation,
                        exam_id,
                        section_no,
                        item_no,
                        text,
                        before_item_no
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.exam_id,
                        OLD.section_no,
                        OLD.item_no,
                        OLD.text,
                        OLD.before_item_no
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_exam_texts_audit_update
            AFTER UPDATE
            ON exam_texts FOR EACH ROW
                BEGIN
                    INSERT INTO exam_texts_audit (
                        modified_by,
                        modified_at,
                        operation,
                        exam_id,
                        section_no,
                        item_no,
                        text,
                        before_item_no
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.exam_id,
                        NEW.section_no,
                        NEW.item_no,
                        NEW.text,
                        NEW.before_item_no
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
        Schema::dropIfExists('exam_texts_audit_trigger');
    }
}
