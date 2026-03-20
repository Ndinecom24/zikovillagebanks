<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('office_task', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('office_id');
            $table->timestamp('assigned_at')->nullable();
            $table->string('status')->default('pending')->comment('pending, acknowledged, completed');
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('process_tasks')->onDelete('cascade');
            $table->foreign('office_id')->references('id')->on('responsible_offices')->onDelete('cascade');
            $table->unique(['task_id', 'office_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('office_task');
    }
};
