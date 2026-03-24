<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Rename process_modules → process_stages and module_id → stage_id.
 * Uses raw Oracle DDL because the Schema facade doesn't support
 * ALTER TABLE … RENAME or RENAME COLUMN on Oracle cleanly.
 */
return new class extends Migration
{
    public function up(): void
    {
        // 1. Rename column process_tasks.module_id → stage_id
        //    Oracle 12c+ supports ALTER TABLE … RENAME COLUMN
        DB::statement('ALTER TABLE process_tasks RENAME COLUMN module_id TO stage_id');

        // 2. Rename the table
        DB::statement('ALTER TABLE process_modules RENAME TO process_stages');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE process_stages RENAME TO process_modules');
        DB::statement('ALTER TABLE process_tasks RENAME COLUMN stage_id TO module_id');
    }
};
