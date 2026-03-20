<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Improve file_uploads table:
     *  - Add original_name to store the human-readable name
     *  - Add mime_type for proper content-type headers
     *  - Add uploaded_by to track who uploaded
     *  - Add description for optional notes
     *  - Index model_id + type for faster lookups
     *  - Fix typo: modal_code → model_code (keep old column for BC)
     */
    public function up()
    {
        Schema::table('file_uploads', function (Blueprint $table) {
            // New columns
            $table->string('original_name')->nullable()->after('name');
            $table->string('mime_type')->nullable()->after('ext');
            $table->string('description')->nullable()->after('type');
            $table->unsignedBigInteger('uploaded_by')->nullable()->after('description');
            $table->string('model_code')->nullable()->after('modal_code');

            // Composite index for fast lookups by entity
            $table->index(['model_id', 'type'], 'file_uploads_model_type_idx');
        });
    }

    public function down()
    {
        Schema::table('file_uploads', function (Blueprint $table) {
            $table->dropIndex('file_uploads_model_type_idx');
            $table->dropColumn(['original_name', 'mime_type', 'description', 'uploaded_by', 'model_code']);
        });
    }
};
