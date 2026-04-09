<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('village_bank_join_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('village_bank_id')->constrained()->cascadeOnDelete();
            $table->string('status', 20)->default('pending'); // pending, approved, rejected
            $table->string('guarantor_username')->nullable();  // username entered by applicant
            $table->foreignId('guarantor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('message')->nullable();               // applicant's note
            $table->text('admin_remarks')->nullable();         // admin's note on approval/rejection
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'village_bank_id', 'status'], 'unique_pending_request');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('village_bank_join_requests');
    }
};
