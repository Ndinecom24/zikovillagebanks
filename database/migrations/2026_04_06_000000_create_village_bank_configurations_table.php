<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('village_bank_configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('village_bank_id')->unique()->constrained('village_banks')->cascadeOnDelete();

            /* ── Insurance defaults ────────────── */
            $table->enum('insurance_type', ['percentage', 'fixed'])->default('percentage');
            $table->decimal('insurance_value', 12, 2)->default(0);

            /* ── Loan settings ─────────────────── */
            $table->unsignedInteger('max_loan_multiplier')->default(3);
            $table->decimal('default_interest_rate', 5, 2)->default(20.00);
            $table->unsignedInteger('default_loan_duration')->default(1);
            $table->boolean('allow_multiple_active_loans')->default(false);
            $table->decimal('min_loan_amount', 12, 2)->nullable();
            $table->decimal('max_loan_amount', 12, 2)->nullable();

            /* ── Penalty settings ──────────────── */
            $table->decimal('late_repayment_penalty_rate', 5, 2)->default(5.00);
            $table->unsignedInteger('grace_period_days')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('village_bank_configurations');
    }
};
