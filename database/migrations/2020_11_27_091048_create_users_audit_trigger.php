<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_users_audit_insert
            AFTER INSERT
            ON users FOR EACH ROW
                BEGIN
                    INSERT INTO users_audit (
                        modified_by,
                        modified_at,
                        operation,
                        user_id,
                        email,
                        user_type_id,
                        password,
                        first_name,
                        middle_name,
                        last_name,
                        suffix_name,
                        photo_src
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.user_id,
                        NEW.email,
                        NEW.user_type_id,
                        NEW.password,
                        NEW.first_name,
                        NEW.middle_name,
                        NEW.last_name,
                        NEW.suffix_name,
                        NEW.photo_src
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_users_audit_delete
            AFTER DELETE
            ON users FOR EACH ROW
                BEGIN
                    INSERT INTO users_audit (
                        modified_by,
                        modified_at,
                        operation,
                        user_id,
                        email,
                        user_type_id,
                        password,
                        first_name,
                        middle_name,
                        last_name,
                        suffix_name,
                        photo_src
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.user_id,
                        OLD.email,
                        OLD.user_type_id,
                        OLD.password,
                        OLD.first_name,
                        OLD.middle_name,
                        OLD.last_name,
                        OLD.suffix_name,
                        OLD.photo_src
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_users_audit_update
            AFTER UPDATE
            ON users FOR EACH ROW
                BEGIN
                    INSERT INTO users_audit (
                        modified_by,
                        modified_at,
                        operation,
                        user_id,
                        email,
                        user_type_id,
                        password,
                        first_name,
                        middle_name,
                        last_name,
                        suffix_name,
                        photo_src
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.user_id,
                        NEW.email,
                        NEW.user_type_id,
                        NEW.password,
                        NEW.first_name,
                        NEW.middle_name,
                        NEW.last_name,
                        NEW.suffix_name,
                        NEW.photo_src
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
        Schema::dropIfExists('users_audit_trigger');
    }
}
