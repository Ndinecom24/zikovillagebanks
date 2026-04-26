<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsLogsTable extends Migration
{
    public function up()
    {
        Schema::create('sms_logs', function (Blueprint $table) {
            $table->id();
            $table->string('recipient', 20)->index();
            $table->text('message');
            $table->string('sender_address', 30)->nullable();
            $table->string('service_code', 30)->nullable();
            $table->string('correlation_id', 60)->nullable();
            $table->string('transaction_id', 60)->nullable()->index();
            $table->string('status_code', 20)->nullable();
            $table->string('status_message', 500)->nullable();
            $table->enum('status', ['sent', 'failed', 'pending', 'delivered'])->default('pending')->index();
            $table->unsignedBigInteger('sent_by')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->foreign('sent_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sms_logs');
    }
}
