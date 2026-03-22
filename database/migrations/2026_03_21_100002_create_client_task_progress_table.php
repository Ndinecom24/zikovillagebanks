<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('client_task_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_process_id');
            $table->unsignedBigInteger('process_task_id');
            $table->string('status')->default('pending')->comment('pending, in_progress, completed, skipped');
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('completed_by')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('client_process_id')->references('id')->on('client_process')->onDelete('cascade');
            $table->foreign('process_task_id')->references('id')->on('process_tasks')->onDelete('cascade');
            $table->foreign('completed_by')->references('id')->on('users')->onDelete('set null');
            $table->unique(['client_process_id', 'process_task_id']);
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_task_progress');
    }
};
