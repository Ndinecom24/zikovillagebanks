<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('client_task_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_task_progress_id');
            $table->unsignedBigInteger('uploaded_by');
            $table->string('original_name');
            $table->string('stored_name');
            $table->string('path');
            $table->string('ext', 20)->nullable();
            $table->string('mime_type')->nullable();
            $table->decimal('size_mb', 10, 2)->default(0)->comment('Size in megabytes');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('client_task_progress_id')->references('id')->on('client_task_progress')->onDelete('cascade');
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('cascade');
            $table->index('client_task_progress_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_task_files');
    }
};
