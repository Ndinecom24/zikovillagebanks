<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Store the compound rate used in each shareout
        Schema::table('shareouts', function (Blueprint $table) {
            $table->decimal('compound_rate', 5, 2)->default(5.00)->after('total_pool');
        });

        // Store per-member compounded values, credit limit, and action
        Schema::table('shareout_allocations', function (Blueprint $table) {
            $table->decimal('investment_compounded', 15, 2)->default(0)->after('contribution_total');
            $table->decimal('insurance_compounded', 15, 2)->default(0)->after('insurance_total');
            $table->decimal('credit_limit', 15, 2)->default(0)->after('loan_deduction');
            $table->string('action', 20)->default('Receiving')->after('payout_amount');
        });
    }

    public function down(): void
    {
        Schema::table('shareouts', function (Blueprint $table) {
            $table->dropColumn('compound_rate');
        });

        Schema::table('shareout_allocations', function (Blueprint $table) {
            $table->dropColumn(['investment_compounded', 'insurance_compounded', 'credit_limit', 'action']);
        });
    }
};
