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
        | CONFIG: constitution toggle + enforcement
        |-------------------------------
        */
        Schema::table('village_bank_configurations', function (Blueprint $table) {
            $table->boolean('constitution_enabled')->default(false)->after('communication_channel');
            $table->boolean('require_constitution_before_activity')->default(true)->after('constitution_enabled');
            $table->boolean('require_rules_before_activity')->default(true)->after('require_constitution_before_activity');
        });

        /*
        |-------------------------------
        | CONSTITUTION per village bank
        |-------------------------------
        | Each bank can either paste text or
        | upload a PDF file as its constitution.
        */
        Schema::create('village_bank_constitutions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('village_bank_id')->constrained()->cascadeOnDelete();
            $table->string('title')->default('Village Bank Constitution');
            $table->enum('content_type', ['text', 'file'])->default('text'); // text or PDF upload
            $table->longText('body')->nullable();                           // for text content
            $table->string('file_path')->nullable();                        // for PDF/doc upload
            $table->string('file_name')->nullable();                        // original file name
            $table->unsignedInteger('version')->default(1);                 // version tracking
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();

            $table->index('village_bank_id');
        });

        /*
        |-------------------------------
        | CONSTITUTION ACKNOWLEDGEMENTS
        |-------------------------------
        | Track which members have read and
        | agreed to the constitution.
        */
        Schema::create('constitution_acknowledgements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('constitution_id')->constrained('village_bank_constitutions')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('version_acknowledged')->default(1);    // which version they signed
            $table->string('ip_address')->nullable();                       // audit trail
            $table->timestamp('acknowledged_at');
            $table->timestamps();

            $table->unique(['constitution_id', 'user_id']);
        });

        /*
        |-------------------------------
        | MEMBER COMPLIANCE TRACKING
        |-------------------------------
        | Quick-lookup columns on the pivot
        | so we don't need expensive queries
        | every time.
        */
        Schema::table('village_bank_members', function (Blueprint $table) {
            $table->boolean('rules_acknowledged')->default(false)->after('joined_at');
            $table->timestamp('rules_acknowledged_at')->nullable()->after('rules_acknowledged');
            $table->boolean('constitution_acknowledged')->default(false)->after('rules_acknowledged_at');
            $table->timestamp('constitution_acknowledged_at')->nullable()->after('constitution_acknowledged');
        });
    }

    public function down(): void
    {
        Schema::table('village_bank_members', function (Blueprint $table) {
            $table->dropColumn([
                'rules_acknowledged',
                'rules_acknowledged_at',
                'constitution_acknowledged',
                'constitution_acknowledged_at',
            ]);
        });

        Schema::dropIfExists('constitution_acknowledgements');
        Schema::dropIfExists('village_bank_constitutions');

        Schema::table('village_bank_configurations', function (Blueprint $table) {
            $table->dropColumn([
                'constitution_enabled',
                'require_constitution_before_activity',
                'require_rules_before_activity',
            ]);
        });
    }
};
