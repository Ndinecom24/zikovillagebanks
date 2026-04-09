<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Creates the user_payment_methods table.
 * Stores bank account details and mobile money details in a single table
 * with a `type` discriminator. Each user can have multiple methods but
 * only ONE can be marked as primary.
 */
class CreateUserPaymentMethodsTable extends Migration
{
    public function up()
    {
        Schema::create('user_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            // Discriminator: 'bank' or 'mobile_money'
            $table->string('type', 20)->default('bank');

            // Label / nickname for user convenience
            $table->string('label', 100)->nullable();

            // ── Bank Account Fields ──
            $table->string('bank_name', 150)->nullable();
            $table->string('account_name', 150)->nullable();
            $table->string('account_number', 50)->nullable();
            $table->string('branch_name', 150)->nullable();
            $table->string('swift_code', 20)->nullable();

            // ── Mobile Money Fields ──
            $table->string('provider', 100)->nullable();       // Airtel Money, MTN MoMo, Zamtel Kwacha, etc.
            $table->string('mobile_number', 30)->nullable();
            $table->string('registered_name', 150)->nullable();

            // ── Common Fields ──
            $table->boolean('is_primary')->default(false);
            $table->string('currency', 10)->default('ZMW');
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->index(['user_id', 'type']);
            $table->index(['user_id', 'is_primary']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_payment_methods');
    }
}
