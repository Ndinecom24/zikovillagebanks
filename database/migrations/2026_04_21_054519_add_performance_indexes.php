<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPerformanceIndexes extends Migration
{
    /**
     * Composite indexes for common query patterns.
     * Single-column FK indexes are already created by foreignId()->constrained() in MySQL.
     */
    public function up()
    {
        // Helper: only add index if it doesn't already exist
        $addIndex = function (string $table, $columns, string $name) {
            if (!Schema::hasTable($table)) return;

            // Check if index already exists (works on MySQL and SQLite)
            $driver = \DB::getDriverName();
            if ($driver === 'sqlite') {
                $exists = \DB::select("PRAGMA index_list(`{$table}`)");
                foreach ($exists as $idx) {
                    if ($idx->name === $name) return;
                }
            } else {
                $exists = \DB::select("SHOW INDEX FROM `{$table}` WHERE Key_name = ?", [$name]);
                if (!empty($exists)) return;
            }

            Schema::table($table, function (Blueprint $t) use ($columns, $name) {
                $t->index($columns, $name);
            });
        };

        $addIndex('activity_logs', ['log_type', 'event'], 'activity_logs_type_event_idx');
        $addIndex('activity_logs', ['subject_type', 'subject_id'], 'activity_logs_subject_idx');
        $addIndex('activity_logs', 'created_at', 'activity_logs_created_idx');
        $addIndex('licenses', ['status', 'expires_at'], 'licenses_status_expiry_idx');
        $addIndex('loans', ['month_id', 'status'], 'loans_month_status_idx');
        $addIndex('share_declarations', ['user_id', 'month_id'], 'share_decl_user_month_idx');
        $addIndex('transactions', ['month_id', 'status'], 'transactions_month_status_idx');
        $addIndex('subscription_payments', 'status', 'sub_payments_status_idx');
    }

    public function down()
    {
        $indexes = [
            'activity_logs' => ['activity_logs_type_event_idx', 'activity_logs_subject_idx', 'activity_logs_created_idx'],
            'licenses' => ['licenses_status_expiry_idx'],
            'loans' => ['loans_month_status_idx'],
            'share_declarations' => ['share_decl_user_month_idx'],
            'transactions' => ['transactions_month_status_idx'],
            'subscription_payments' => ['sub_payments_status_idx'],
        ];

        foreach ($indexes as $table => $idxList) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) use ($idxList) {
                    foreach ($idxList as $idx) {
                        $table->dropIndex($idx);
                    }
                });
            }
        }
    }
}
