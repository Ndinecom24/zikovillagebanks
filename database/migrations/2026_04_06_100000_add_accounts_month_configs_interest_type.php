<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        /* ─── 1. Payment / Bank Accounts per Village Bank ─── */
        Schema::create('village_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('village_bank_id')->constrained('village_banks')->cascadeOnDelete();
            $table->enum('account_type', ['bank_account', 'mobile_money'])->default('mobile_money');
            $table->string('provider_name', 100);           // e.g. "Airtel Money", "FNB", "Zanaco"
            $table->string('account_name', 150);
            $table->string('account_number', 80);
            $table->string('branch', 100)->nullable();       // bank branch (only for bank_account)
            $table->boolean('is_active')->default(true);
            $table->boolean('is_primary')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        /* ─── 2. Month templates per Village Bank ─── */
        Schema::create('village_bank_month_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('village_bank_id')->constrained('village_banks')->cascadeOnDelete();
            $table->unsignedSmallInteger('month_number');
            $table->string('label', 100)->nullable();        // e.g. "Month 1 – Opening", "Month 12 – Shareout"
            $table->boolean('allow_share_declarations')->default(true);
            $table->boolean('allow_insurance_declarations')->default(true);
            $table->boolean('allow_loan_requests')->default(true);
            $table->boolean('allow_loan_repayments')->default(true);
            $table->boolean('is_shareout_month')->default(false);
            $table->timestamps();

            $table->unique(['village_bank_id', 'month_number'], 'vb_month_cfg_unique');
        });

        /* ─── 3. Extend village_bank_configurations ─── */
        Schema::table('village_bank_configurations', function (Blueprint $table) {
            // Circle duration
            $table->unsignedSmallInteger('circle_duration_months')->default(12)->after('village_bank_id');

            // Interest model
            $table->enum('interest_type', ['flat', 'reducing_balance'])->default('flat')->after('default_interest_rate');
            $table->decimal('reducing_balance_rate', 5, 2)->default(0)->after('interest_type');
        });

        /* ─── 4. Add activity flags to months table ─── */
        Schema::table('months', function (Blueprint $table) {
            $table->string('label', 100)->nullable()->after('month_number');
            $table->boolean('allow_share_declarations')->default(true)->after('label');
            $table->boolean('allow_insurance_declarations')->default(true)->after('allow_share_declarations');
            $table->boolean('allow_loan_requests')->default(true)->after('allow_insurance_declarations');
            $table->boolean('allow_loan_repayments')->default(true)->after('allow_loan_requests');
            $table->boolean('is_shareout_month')->default(false)->after('allow_loan_repayments');
        });
    }

    public function down()
    {
        Schema::table('months', function (Blueprint $table) {
            $table->dropColumn([
                'label',
                'allow_share_declarations',
                'allow_insurance_declarations',
                'allow_loan_requests',
                'allow_loan_repayments',
                'is_shareout_month',
            ]);
        });

        Schema::table('village_bank_configurations', function (Blueprint $table) {
            $table->dropColumn([
                'circle_duration_months',
                'interest_type',
                'reducing_balance_rate',
            ]);
        });

        Schema::dropIfExists('village_bank_month_configs');
        Schema::dropIfExists('village_bank_accounts');
    }
};
