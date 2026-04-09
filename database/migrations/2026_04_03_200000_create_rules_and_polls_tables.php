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
        | RULES (per village bank)
        |-------------------------------
        | Admins define rules/bylaws that
        | govern how a village bank operates.
        */
        Schema::create('village_bank_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('village_bank_id')->constrained()->cascadeOnDelete();
            $table->string('title');                                // e.g. "Late Payment Penalty"
            $table->text('description');                            // full rule text
            $table->string('category')->default('general');         // general, loans, shares, penalties, membership, meetings
            $table->integer('sort_order')->default(0);              // display ordering
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });

        /*
        |-------------------------------
        | RULE ACKNOWLEDGEMENTS
        |-------------------------------
        | Track which members have read /
        | accepted the rules.
        */
        Schema::create('rule_acknowledgements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rule_id')->constrained('village_bank_rules')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamp('acknowledged_at');
            $table->timestamps();

            $table->unique(['rule_id', 'user_id']);
        });

        /*
        |-------------------------------
        | POLLS / VOTES
        |-------------------------------
        | Admins create polls with a question
        | and multiple options. Members vote.
        */
        Schema::create('polls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('village_bank_id')->constrained()->cascadeOnDelete();
            $table->string('question');
            $table->text('description')->nullable();
            $table->enum('type', ['single', 'multiple'])->default('single');    // single-choice or multi-choice
            $table->boolean('is_anonymous')->default(false);                    // hide voter identity
            $table->enum('status', ['draft', 'active', 'closed'])->default('draft');
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });

        Schema::create('poll_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poll_id')->constrained()->cascadeOnDelete();
            $table->string('label');                         // e.g. "Yes", "No", "Increase to 25%"
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('poll_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poll_id')->constrained()->cascadeOnDelete();
            $table->foreignId('poll_option_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            // For single-choice: one vote per user per poll
            $table->unique(['poll_id', 'poll_option_id', 'user_id']);
        });

        /*
        |-------------------------------
        | POLL COMMENTS (discussion thread)
        |-------------------------------
        */
        Schema::create('poll_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poll_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('body');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poll_comments');
        Schema::dropIfExists('poll_votes');
        Schema::dropIfExists('poll_options');
        Schema::dropIfExists('polls');
        Schema::dropIfExists('rule_acknowledgements');
        Schema::dropIfExists('village_bank_rules');
    }
};
