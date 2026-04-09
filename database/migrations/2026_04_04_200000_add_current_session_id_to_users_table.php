<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddCurrentSessionIdToUsersTable extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE users ADD COLUMN current_session_id VARCHAR(255) NULL AFTER remember_token");
    }

    public function down()
    {
        DB::statement("ALTER TABLE users DROP COLUMN current_session_id");
    }
}
