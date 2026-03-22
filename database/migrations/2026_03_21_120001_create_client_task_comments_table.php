<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('client_task_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_task_progress_id');
            $table->unsignedBigInteger('user_id');
            $table->text('body');
            $table->timestamps();

            $table->foreign('client_task_progress_id')->references('id')->on('client_task_progress')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('client_task_progress_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_task_comments');
    }
};
