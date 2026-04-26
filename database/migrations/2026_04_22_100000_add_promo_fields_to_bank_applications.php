<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bank_applications', function (Blueprint $table) {
            $table->foreignId('promo_code_id')
                  ->nullable()
                  ->after('payment_reference')
                  ->constrained('promo_codes')
                  ->nullOnDelete();

            $table->decimal('promo_discount', 12, 2)
                  ->default(0)
                  ->after('promo_code_id');

            $table->decimal('amount_due', 12, 2)
                  ->default(0)
                  ->after('promo_discount');
        });
    }

    public function down(): void
    {
        Schema::table('bank_applications', function (Blueprint $table) {
            $table->dropForeign(['promo_code_id']);
            $table->dropColumn(['promo_code_id', 'promo_discount', 'amount_due']);
        });
    }
};
