<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Add a `type` column to loans to distinguish voluntary vs forced loans,
 * and a `forced_by` column to track which admin triggered the forced loan.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->string('type', 20)->default('voluntary')->after('status');
            $table->foreignId('forced_by')->nullable()->after('type')->constrained('users')->nullOnDelete();
            $table->text('notes')->nullable()->after('forced_by');
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropForeign(['forced_by']);
            $table->dropColumn(['type', 'forced_by', 'notes']);
        });
    }
};
