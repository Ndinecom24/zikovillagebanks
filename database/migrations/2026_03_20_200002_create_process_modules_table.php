<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('process_modules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('process_id')->references('id')->on('processes')->onDelete('cascade');
            $table->index('process_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('process_modules');
    }
};
