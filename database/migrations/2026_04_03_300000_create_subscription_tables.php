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
        | SUBSCRIPTION PLANS
        |-------------------------------
        | Platform-wide pricing tiers.
        */
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');                                         // e.g. "Basic", "Standard", "Premium"
            $table->string('slug')->unique();                               // e.g. "basic", "standard", "premium"
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);                                // price in Kwacha
            $table->enum('billing_cycle', ['monthly', 'quarterly', 'yearly'])->default('monthly');
            $table->integer('duration_days');                                // license validity e.g. 30, 90, 365
            $table->integer('max_circles')->nullable();                     // null = unlimited
            $table->integer('max_members')->nullable();                     // null = unlimited
            $table->json('features')->nullable();                           // JSON list of feature flags
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);                 // highlight on landing page
            $table->timestamps();
        });

        /*
        |-------------------------------
        | SUBSCRIPTIONS
        |-------------------------------
        | A village bank's subscription record.
        */
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('village_bank_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subscription_plan_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['pending', 'active', 'expired', 'cancelled'])->default('pending');
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->boolean('auto_renew')->default(false);
            $table->timestamps();
        });

        /*
        |-------------------------------
        | SUBSCRIPTION PAYMENTS
        |-------------------------------
        | Proof-of-payment uploads for subscription.
        */
        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->constrained()->cascadeOnDelete();
            $table->foreignId('paid_by')->constrained('users');
            $table->decimal('amount', 12, 2);
            $table->string('reference')->nullable();                        // bank reference / receipt number
            $table->string('proof_file');                                    // uploaded proof path
            $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending');
            $table->text('admin_remarks')->nullable();                      // reason for rejection, etc.
            $table->foreignId('reviewed_by')->nullable()->constrained('users');
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });

        /*
        |-------------------------------
        | LICENSES
        |-------------------------------
        | Auto-generated upon payment confirmation.
        */
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('village_bank_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subscription_id')->constrained()->cascadeOnDelete();
            $table->string('license_key', 40)->unique();                    // e.g. "VB-XXXX-XXXX-XXXX"
            $table->enum('status', ['active', 'expired', 'revoked'])->default('active');
            $table->timestamp('issued_at');
            $table->timestamp('expires_at');
            $table->timestamp('revoked_at')->nullable();
            $table->text('revoke_reason')->nullable();
            $table->timestamps();
        });

        /*
        |-------------------------------
        | BANK APPLICATIONS (pre-registration)
        |-------------------------------
        | Public form submissions before a user account exists.
        */
        Schema::create('bank_applications', function (Blueprint $table) {
            $table->id();
            // Applicant info
            $table->string('bank_name');
            $table->string('bank_code', 20)->nullable();
            $table->text('bank_description')->nullable();
            $table->string('bank_address')->nullable();
            $table->string('bank_phone');
            $table->string('bank_email');
            // Contact person
            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->string('contact_staff_no')->nullable();                 // if they want to become the admin user
            // Plan & Payment
            $table->foreignId('subscription_plan_id')->constrained();
            $table->string('proof_file')->nullable();                       // payment proof
            $table->string('payment_reference')->nullable();
            // Status
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_remarks')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users');
            $table->timestamp('reviewed_at')->nullable();
            // Link to created bank after approval
            $table->foreignId('village_bank_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_applications');
        Schema::dropIfExists('licenses');
        Schema::dropIfExists('subscription_payments');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('subscription_plans');
    }
};
