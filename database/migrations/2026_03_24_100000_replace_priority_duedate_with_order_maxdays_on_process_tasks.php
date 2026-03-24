<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('process_tasks', function (Blueprint $table) {
            // Add new columns
            $table->unsignedInteger('order_number')->default(1)->after('module_id')
                  ->comment('Sequential order within the module');
            $table->unsignedInteger('max_days')->nullable()->after('description')
                  ->comment('Maximum number of days allowed for this task');

            // Drop old columns
            $table->dropIndex(['priority']); // drop the index first
            $table->dropColumn(['priority', 'due_date']);
        });

        // Back-fill order_number per module based on existing id order (Oracle syntax)
        DB::statement('
            MERGE INTO process_tasks pt
            USING (
                SELECT id,
                       ROW_NUMBER() OVER (PARTITION BY module_id ORDER BY id) AS rn
                FROM process_tasks
                WHERE deleted_at IS NULL
            ) ranked
            ON (pt.id = ranked.id)
            WHEN MATCHED THEN
                UPDATE SET pt.order_number = ranked.rn
        ');
    }

    public function down()
    {
        Schema::table('process_tasks', function (Blueprint $table) {
            $table->string('priority')->default('medium')->after('description');
            $table->date('due_date')->nullable()->after('priority');
            $table->index('priority');
            $table->dropColumn(['order_number', 'max_days']);
        });
    }
};
