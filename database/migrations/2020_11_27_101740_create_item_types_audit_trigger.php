<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTypesAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_item_types_audit_insert
            AFTER INSERT
            ON item_types FOR EACH ROW
                BEGIN
                    INSERT INTO item_types_audit (
                        modified_by,
                        modified_at,
                        operation,
                        item_type_id,
                        item_type
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.item_type_id,
                        NEW.item_type
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_item_types_audit_delete
            AFTER DELETE
            ON item_types FOR EACH ROW
                BEGIN
                    INSERT INTO item_types_audit (
                        modified_by,
                        modified_at,
                        operation,
                        item_type_id,
                        item_type
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.item_type_id,
                        OLD.item_type
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_item_types_audit_update
            AFTER UPDATE
            ON item_types FOR EACH ROW
                BEGIN
                    INSERT INTO item_types_audit (
                        modified_by,
                        modified_at,
                        operation,
                        item_type_id,
                        item_type
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.item_type_id,
                        NEW.item_type
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
        Schema::dropIfExists('item_types_audit_trigger');
    }
}
