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
        | VILLAGE BANKS (multi-tenant)
        |-------------------------------
        */
        Schema::create('village_banks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code', 20)->unique();
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });

        /*
        |-------------------------------
        | VILLAGE BANK MEMBERS (pivot)
        |-------------------------------
        */
        Schema::create('village_bank_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('village_bank_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('role', ['admin', 'member'])->default('member');
            $table->timestamp('joined_at')->nullable();
            $table->timestamps();

            $table->unique(['village_bank_id', 'user_id']);
        });

        /*
        |-------------------------------
        | SCOPE CIRCLES TO VILLAGE BANK
        |-------------------------------
        */
        Schema::table('circles', function (Blueprint $table) {
            $table->foreignId('village_bank_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('circles', function (Blueprint $table) {
            $table->dropForeign(['village_bank_id']);
            $table->dropColumn('village_bank_id');
        });
        Schema::dropIfExists('village_bank_members');
        Schema::dropIfExists('village_banks');
    }
};
