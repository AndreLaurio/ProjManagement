<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomExamineesAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_room_examinees_audit_insert
            AFTER INSERT
            ON room_examinees FOR EACH ROW
                BEGIN
                    INSERT INTO room_examinees_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        examinee_id
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.room_id,
                        NEW.examinee_id
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_room_examinees_audit_delete
            AFTER DELETE
            ON room_examinees FOR EACH ROW
                BEGIN
                    INSERT INTO room_examinees_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        examinee_id
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.room_id,
                        OLD.examinee_id
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_room_examinees_audit_update
            AFTER UPDATE
            ON room_examinees FOR EACH ROW
                BEGIN
                    INSERT INTO room_examinees_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        examinee_id
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.room_id,
                        NEW.examinee_id
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
        Schema::dropIfExists('room_examinees_audit_trigger');
    }
}
