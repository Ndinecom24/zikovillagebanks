<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('folder_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('file_name');
            $table->string('original_name');
            $table->string('file_path');
            $table->string('file_type')->nullable();
            $table->string('file_extension')->nullable();
            $table->string('mime_type')->nullable();
            $table->decimal('file_size', 12, 2)->default(0)->comment('Size in MB');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('uploaded_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('folder_id')->references('id')->on('document_folders')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('document_categories')->onDelete('set null');
            $table->foreign('client_id')->references('id')->on('independent_producers')->onDelete('set null');
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('set null');

            $table->index(['folder_id', 'category_id'], 'documents_folder_category_idx');
            $table->index('client_id', 'documents_client_idx');
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
