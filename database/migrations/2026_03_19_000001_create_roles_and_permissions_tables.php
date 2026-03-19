<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesAndPermissionsTables extends Migration
{
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();       // e.g. "create-ipp"
            $table->string('slug')->unique();        // e.g. "create-ipp"
            $table->string('description')->nullable();
            $table->string('group')->nullable();     // e.g. "IPP Management"
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();       // e.g. "Admin"
            $table->string('slug')->unique();        // e.g. "admin"
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('role_permission', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete();
            $table->foreignId('permission_id')->constrained('permissions')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['role_id', 'permission_id']);
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'role_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('role_permission');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
    }
}
