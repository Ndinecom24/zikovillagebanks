<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /* ── Flag: does this bank give insurance profit to members? ── */
        Schema::table('village_bank_configurations', function (Blueprint $table) {
            $table->boolean('insurance_profit_to_members')
                  ->default(true)
                  ->after('insurance_value')
                  ->comment('false = insurance profit goes to social fund');
        });

        /* ── Social fund per circle ── */
        Schema::create('social_funds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('circle_id')->constrained()->cascadeOnDelete();
            $table->foreignId('shareout_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('total_insurance_profit', 15, 2)->default(0);
            $table->decimal('total_penalties', 15, 2)->default(0);
            $table->decimal('total_fund', 15, 2)->default(0);
            $table->decimal('total_used', 15, 2)->default(0);
            $table->decimal('total_remaining', 15, 2)->default(0);
            $table->enum('status', ['active', 'depleted', 'closed'])->default('active');
            $table->timestamps();
        });

        /* ── Individual usage records ── */
        Schema::create('social_fund_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('social_fund_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['shareout', 'donation', 'payment', 'other'])->default('other');
            $table->string('description');
            $table->decimal('amount', 15, 2);
            $table->string('recipient')->nullable()->comment('Person or organisation receiving funds');
            $table->date('usage_date');
            $table->foreignId('recorded_by')->constrained('users')->cascadeOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_fund_usages');
        Schema::dropIfExists('social_funds');

        Schema::table('village_bank_configurations', function (Blueprint $table) {
            $table->dropColumn('insurance_profit_to_members');
        });
    }
};
