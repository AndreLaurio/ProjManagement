<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomExamsAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_room_exams_audit_insert
            AFTER INSERT
            ON room_exams FOR EACH ROW
                BEGIN
                    INSERT INTO room_exams_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        exam_id,
                        open_at,
                        close_at,
                        time_limit,
                        is_open_at_enabled,
                        is_close_at_enabled,
                        is_time_limit_enabled
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.room_id,
                        NEW.exam_id,
                        NEW.open_at,
                        NEW.close_at,
                        NEW.time_limit,
                        NEW.is_open_at_enabled,
                        NEW.is_close_at_enabled,
                        NEW.is_time_limit_enabled
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_room_exams_audit_delete
            AFTER DELETE
            ON room_exams FOR EACH ROW
                BEGIN
                    INSERT INTO room_exams_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        exam_id,
                        open_at,
                        close_at,
                        time_limit,
                        is_open_at_enabled,
                        is_close_at_enabled,
                        is_time_limit_enabled
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.room_id,
                        OLD.exam_id,
                        OLD.open_at,
                        OLD.close_at,
                        OLD.time_limit,
                        OLD.is_open_at_enabled,
                        OLD.is_close_at_enabled,
                        OLD.is_time_limit_enabled
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_room_exams_audit_update
            AFTER UPDATE
            ON room_exams FOR EACH ROW
                BEGIN
                    INSERT INTO room_exams_audit (
                        modified_by,
                        modified_at,
                        operation,
                        room_id,
                        exam_id,
                        open_at,
                        close_at,
                        time_limit,
                        is_open_at_enabled,
                        is_close_at_enabled,
                        is_time_limit_enabled
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.room_id,
                        NEW.exam_id,
                        NEW.open_at,
                        NEW.close_at,
                        NEW.time_limit,
                        NEW.is_open_at_enabled,
                        NEW.is_close_at_enabled,
                        NEW.is_time_limit_enabled
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
        Schema::dropIfExists('room_exams_audit_trigger');
    }
}
