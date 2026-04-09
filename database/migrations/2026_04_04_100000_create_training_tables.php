<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingTables extends Migration
{
    public function up()
    {
        // Training programs / courses posted by admin
        Schema::create('training_programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('category')->default('general');       // general, finance, governance, management
            $table->string('trainer')->nullable();                // trainer / facilitator name
            $table->string('location')->nullable();               // venue or "Online"
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('duration')->nullable();               // e.g. "3 days", "2 weeks"
            $table->decimal('fee', 12, 2)->default(0);            // 0 = free
            $table->unsignedInteger('max_participants')->nullable();
            $table->string('cover_image')->nullable();
            $table->enum('status', ['draft', 'published', 'closed', 'completed'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        // Applications from users to join a training program
        Schema::create('training_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_program_id')->constrained('training_programs')->onDelete('cascade');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('village_bank')->nullable();           // which village bank they belong to
            $table->string('role_in_bank')->nullable();           // e.g. chairperson, treasurer, member
            $table->text('motivation')->nullable();               // why they want to attend
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_applications');
        Schema::dropIfExists('training_programs');
    }
}
