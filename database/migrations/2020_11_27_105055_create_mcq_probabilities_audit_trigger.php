<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcqProbabilitiesAuditTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_mcq_probabilities_audit_insert
            AFTER INSERT
            ON mcq_probabilities FOR EACH ROW
                BEGIN
                    INSERT INTO mcq_probabilities_audit (
                        modified_by,
                        modified_at,
                        operation,
                        mcq_probability_id,
                        mcq_probability
                    ) 
                    VALUES (
                        NEW.created_by,
                        NEW.created_at,
                        'I',
                        NEW.mcq_probability_id,
                        NEW.mcq_probability
                    );
                END
        ");
        
        DB::unprepared("
            CREATE TRIGGER tr_mcq_probabilities_audit_delete
            AFTER DELETE
            ON mcq_probabilities FOR EACH ROW
                BEGIN
                    INSERT INTO mcq_probabilities_audit (
                        modified_by,
                        modified_at,
                        operation,
                        mcq_probability_id,
                        mcq_probability
                    ) 
                    VALUES (
                        OLD.updated_by,
                        OLD.updated_at,
                        'D',
                        OLD.mcq_probability_id,
                        OLD.mcq_probability
                    );
                END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_mcq_probabilities_audit_update
            AFTER UPDATE
            ON mcq_probabilities FOR EACH ROW
                BEGIN
                    INSERT INTO mcq_probabilities_audit (
                        modified_by,
                        modified_at,
                        operation,
                        mcq_probability_id,
                        mcq_probability
                    ) 
                    VALUES (
                        NEW.updated_by,
                        NEW.updated_at,
                        'U',
                        NEW.mcq_probability_id,
                        NEW.mcq_probability
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
        Schema::dropIfExists('mcq_probabilities_audit_trigger');
    }
}
