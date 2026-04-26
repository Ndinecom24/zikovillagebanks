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
        | Discount columns on subscription_plans
        |-------------------------------
        | Allows each plan to carry an optional time-limited
        | promotional discount so admins can run campaigns.
        */
        Schema::table('subscription_plans', function (Blueprint $table) {
            $table->enum('discount_type', ['none', 'percentage', 'fixed'])
                  ->default('none')
                  ->after('price');

            $table->decimal('discount_value', 12, 2)
                  ->default(0)
                  ->after('discount_type');

            $table->timestamp('discount_starts_at')
                  ->nullable()
                  ->after('discount_value');

            $table->timestamp('discount_ends_at')
                  ->nullable()
                  ->after('discount_starts_at');

            $table->string('discount_label', 100)
                  ->nullable()
                  ->after('discount_ends_at');  // e.g. "Launch Special", "Black Friday"
        });

        /*
        |-------------------------------
        | Promo / coupon codes (standalone table)
        |-------------------------------
        | Separate from plan-level discounts.
        | Admins create codes that users enter at checkout.
        */
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 40)->unique();                       // e.g. "SAVE20", "WELCOME"
            $table->string('description')->nullable();
            $table->enum('type', ['percentage', 'fixed'])->default('percentage');
            $table->decimal('value', 12, 2);                            // e.g. 20 (= 20 %)
            $table->decimal('min_plan_price', 12, 2)->default(0);       // plan must cost at least X
            $table->integer('max_uses')->nullable();                    // null = unlimited
            $table->integer('times_used')->default(0);
            $table->integer('max_uses_per_bank')->default(1);           // per village bank
            $table->foreignId('plan_id')->nullable()                    // restrict to one plan (null = any)
                  ->constrained('subscription_plans')->nullOnDelete();
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        /*
        |-------------------------------
        | Promo code usage log
        |-------------------------------
        */
        Schema::create('promo_code_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promo_code_id')->constrained()->cascadeOnDelete();
            $table->foreignId('village_bank_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subscription_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('discount_applied', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promo_code_usages');
        Schema::dropIfExists('promo_codes');

        Schema::table('subscription_plans', function (Blueprint $table) {
            $table->dropColumn([
                'discount_type', 'discount_value',
                'discount_starts_at', 'discount_ends_at', 'discount_label',
            ]);
        });
    }
};
