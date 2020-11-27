<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_rooms_audit_insert
            AFTER INSERT
            ON rooms FOR EACH ROW
                BEGIN
                    INSERT INTO rooms_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        examiner_id,
                        room_code,
                        room_title,
                        room_desc,
                        total_examinees,
                        total_exams
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.room_id,
                        NEW.examiner_id,
                        NEW.room_code,
                        NEW.room_title,
                        NEW.room_desc,
                        NEW.total_examinees,
                        NEW.total_exams
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_rooms_audit_delete
            AFTER DELETE
            ON rooms FOR EACH ROW
                BEGIN
                    INSERT INTO rooms_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        examiner_id,
                        room_code,
                        room_title,
                        room_desc,
                        total_examinees,
                        total_exams
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.room_id,
                        OLD.examiner_id,
                        OLD.room_code,
                        OLD.room_title,
                        OLD.room_desc,
                        OLD.total_examinees,
                        OLD.total_exams
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_rooms_audit_update
            AFTER UPDATE
            ON rooms FOR EACH ROW
                BEGIN
                    INSERT INTO rooms_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        examiner_id,
                        room_code,
                        room_title,
                        room_desc,
                        total_examinees,
                        total_exams
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.room_id,
                        NEW.examiner_id,
                        NEW.room_code,
                        NEW.room_title,
                        NEW.room_desc,
                        NEW.total_examinees,
                        NEW.total_exams
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
        Schema::dropIfExists('rooms_audit_trigger');
    }
}
