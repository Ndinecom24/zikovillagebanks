<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tables that need soft-delete support.
     */
    private array $tables = [
        'loans',
        'repayments',
        'transactions',
        'share_declarations',
        'circles',
        'shareout_allocations',
        'subscriptions',
        'licenses',
    ];

    public function up(): void
    {
        // Fix non-nullable timestamp columns in licenses before altering
        // (MySQL strict mode rejects implicit 0000-00-00 defaults on ALTER)
        if (Schema::hasTable('licenses')) {
            Schema::table('licenses', function (Blueprint $t) {
                $t->timestamp('issued_at')->nullable()->change();
                $t->timestamp('expires_at')->nullable()->change();
            });
        }

        foreach ($this->tables as $table) {
            if (Schema::hasTable($table) && ! Schema::hasColumn($table, 'deleted_at')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->softDeletes();
                });
            }
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'deleted_at')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->dropSoftDeletes();
                });
            }
        }
    }
};
