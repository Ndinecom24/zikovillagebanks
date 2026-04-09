<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add insurance totals to the shareout summary
        Schema::table('shareouts', function (Blueprint $table) {
            $table->decimal('total_insurance', 15, 2)->default(0)->after('total_contributions');
            $table->decimal('total_loans_outstanding', 15, 2)->default(0)->after('total_penalties');
        });

        // Add per-member breakdown columns to allocations
        Schema::table('shareout_allocations', function (Blueprint $table) {
            $table->decimal('insurance_total', 15, 2)->default(0)->after('contribution_total');
            $table->decimal('shares_profit', 15, 2)->default(0)->after('insurance_total');
            $table->decimal('insurance_profit', 15, 2)->default(0)->after('shares_profit');
            $table->decimal('loan_deduction', 15, 2)->default(0)->after('insurance_profit');
        });
    }

    public function down(): void
    {
        Schema::table('shareouts', function (Blueprint $table) {
            $table->dropColumn(['total_insurance', 'total_loans_outstanding']);
        });

        Schema::table('shareout_allocations', function (Blueprint $table) {
            $table->dropColumn(['insurance_total', 'shares_profit', 'insurance_profit', 'loan_deduction']);
        });
    }
};
