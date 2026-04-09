<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentConfigurationsTable extends Migration
{
    public function up()
    {
        Schema::create('payment_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('method_name');                   // e.g. "Mobile Money", "Bank Transfer"
            $table->string('provider')->nullable();          // e.g. "Airtel Money", "Zanaco"
            $table->string('account_name')->nullable();      // e.g. "Ndinecom Solutions Ltd"
            $table->string('account_number')->nullable();    // e.g. "0012345678"
            $table->string('branch')->nullable();            // e.g. "Cairo Road Branch"
            $table->text('instructions')->nullable();        // additional payment instructions
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_configurations');
    }
}
