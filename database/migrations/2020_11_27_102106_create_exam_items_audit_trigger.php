<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamItemsAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_exam_items_audit_insert
            AFTER INSERT
            ON exam_items FOR EACH ROW
                BEGIN
                    INSERT INTO exam_items_audit (
                        modified_by,
                        modified_at,
                        operation,
                        exam_id,
                        section_no,
                        item_no,
                        item_type_id
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.exam_id,
                        NEW.section_no,
                        NEW.item_no,
                        NEW.item_type_id
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_exam_items_audit_delete
            AFTER DELETE
            ON exam_items FOR EACH ROW
                BEGIN
                    INSERT INTO exam_items_audit (
                        modified_by,
                        modified_at,
                        operation,
                        exam_id,
                        section_no,
                        item_no,
                        item_type_id
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.exam_id,
                        OLD.section_no,
                        OLD.item_no,
                        OLD.item_type_id
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_exam_items_audit_update
            AFTER UPDATE
            ON exam_items FOR EACH ROW
                BEGIN
                    INSERT INTO exam_items_audit (
                        modified_by,
                        modified_at,
                        operation,
                        exam_id,
                        section_no,
                        item_no,
                        item_type_id
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.exam_id,
                        NEW.section_no,
                        NEW.item_no,
                        NEW.item_type_id
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
        Schema::dropIfExists('exam_items_audit_trigger');
    }
}
