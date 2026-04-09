<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |-------------------------------
        | USERS (extend existing)
        |-------------------------------
        */
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('guarantor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('phone')->nullable();
            $table->enum('status', ['pending','active','suspended'])->default('pending');
        });

        /*
        |-------------------------------
        | CIRCLES
        |-------------------------------
        */
        Schema::create('circles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('duration_months');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status',['draft','active','completed'])->default('draft');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });

        Schema::create('circle_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('circle_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamp('joined_at')->nullable();
        });

        /*
        |-------------------------------
        | MONTHS & PHASES
        |-------------------------------
        */
        Schema::create('months', function (Blueprint $table) {
            $table->id();
            $table->foreignId('circle_id')->constrained()->cascadeOnDelete();
            $table->integer('month_number');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status',['pending','active','closed'])->default('pending');
            $table->timestamps();
        });

        Schema::create('phases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('month_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status',['pending','active','completed'])->default('pending');
            $table->timestamps();
        });

        /*
        |-------------------------------
        | SHARES & INSURANCE
        |-------------------------------
        */
        Schema::create('share_declarations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('month_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->timestamps();
        });

        Schema::create('insurance_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('circle_id')->constrained()->cascadeOnDelete();
            $table->enum('type',['percentage','fixed']);
            $table->decimal('value', 12, 2);
            $table->timestamps();
        });

        Schema::create('insurance_contributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('month_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->timestamps();
        });

        /*
        |-------------------------------
        | LOANS
        |-------------------------------
        */
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrower_id')->constrained('users');
            $table->foreignId('month_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->integer('duration')->default(1);
            $table->decimal('total_payable', 12, 2)->nullable();
            $table->decimal('outstanding_balance', 12, 2)->nullable();
            $table->enum('status',['pending','approved','rejected','active','completed'])->default('pending');
            $table->timestamps();
        });

        Schema::create('loan_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('approved_by')->constrained('users');
            $table->string('status');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });

        /*
        |-------------------------------
        | PAIRING
        |-------------------------------
        */
        Schema::create('loan_pairings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lender_id')->constrained('users');
            $table->decimal('amount', 12, 2);
            $table->timestamps();
        });

        /*
        |-------------------------------
        | PAYMENTS
        |-------------------------------
        */
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type',['mobile_money','bank']);
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users');
            $table->foreignId('receiver_id')->constrained('users');
            $table->foreignId('loan_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('month_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('amount', 12, 2);
            $table->foreignId('payment_method_id')->constrained();
            $table->string('proof_file')->nullable();
            $table->enum('status',['pending','confirmed','rejected'])->default('pending');
            $table->timestamps();
        });

        /*
        |-------------------------------
        | REPAYMENTS & PENALTIES
        |-------------------------------
        */
        Schema::create('repayments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount_paid', 12, 2);
            $table->decimal('remaining_balance', 12, 2);
            $table->decimal('penalty_applied', 12, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('penalties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained()->cascadeOnDelete();
            $table->decimal('percentage', 5, 2);
            $table->decimal('amount', 12, 2);
            $table->timestamp('applied_at');
        });

        /*
        |-------------------------------
        | SHAREOUT
        |-------------------------------
        */
        Schema::create('shareouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('circle_id')->constrained()->cascadeOnDelete();
            $table->decimal('total_contributions', 15, 2);
            $table->decimal('total_interest', 15, 2);
            $table->decimal('total_penalties', 15, 2);
            $table->decimal('total_pool', 15, 2);
            $table->timestamps();
        });

        Schema::create('shareout_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shareout_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('contribution_total', 15, 2);
            $table->decimal('profit_share', 15, 2);
            $table->decimal('payout_amount', 15, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shareout_allocations');
        Schema::dropIfExists('shareouts');
        Schema::dropIfExists('penalties');
        Schema::dropIfExists('repayments');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('payment_methods');
        Schema::dropIfExists('loan_pairings');
        Schema::dropIfExists('loan_approvals');
        Schema::dropIfExists('loans');
        Schema::dropIfExists('insurance_contributions');
        Schema::dropIfExists('insurance_configs');
        Schema::dropIfExists('share_declarations');
        Schema::dropIfExists('phases');
        Schema::dropIfExists('months');
        Schema::dropIfExists('circle_members');
        Schema::dropIfExists('circles');
    }
};