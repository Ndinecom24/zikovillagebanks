<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrentSessionIdToUsersTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('users', 'current_session_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('current_session_id')->nullable()->after('remember_token');
            });
        }
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('current_session_id');
        });
    }
}
