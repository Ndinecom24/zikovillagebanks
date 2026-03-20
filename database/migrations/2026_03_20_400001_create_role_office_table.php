<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('role_office', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('office_id');
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('office_id')->references('id')->on('responsible_offices')->onDelete('cascade');
            $table->unique(['role_id', 'office_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_office');
    }
};
