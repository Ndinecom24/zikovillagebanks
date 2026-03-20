<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('process_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('priority')->default('medium')->comment('low, medium, high');
            $table->date('due_date')->nullable();
            $table->string('status')->default('pending')->comment('pending, in_progress, completed');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('module_id')->references('id')->on('process_modules')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->index('module_id');
            $table->index('status');
            $table->index('priority');
        });
    }

    public function down()
    {
        Schema::dropIfExists('process_tasks');
    }
};
