<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Add communication_channel to village_bank_configurations
        Schema::table('village_bank_configurations', function (Blueprint $table) {
            $table->enum('communication_channel', ['email', 'sms', 'both', 'none'])
                  ->default('email')
                  ->after('grace_period_days');
        });

        // 2. Create communications table for message history
        Schema::create('communications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('village_bank_id')->constrained('village_banks')->cascadeOnDelete();
            $table->enum('channel', ['email', 'sms'])->index();
            $table->string('subject', 255)->nullable();              // email subject; null for SMS
            $table->text('message');
            $table->enum('recipient_type', ['all', 'selected'])->default('all');
            $table->json('recipient_ids')->nullable();               // user IDs if selected
            $table->unsignedInteger('total_recipients')->default(0);
            $table->unsignedInteger('sent_count')->default(0);
            $table->unsignedInteger('failed_count')->default(0);
            $table->enum('status', ['draft', 'sending', 'sent', 'failed'])->default('draft')->index();
            $table->foreignId('sent_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('communications');

        Schema::table('village_bank_configurations', function (Blueprint $table) {
            $table->dropColumn('communication_channel');
        });
    }
};
