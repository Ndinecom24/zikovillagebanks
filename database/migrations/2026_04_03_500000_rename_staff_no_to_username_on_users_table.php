<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (DB::getDriverName() === 'sqlite') {
            // SQLite 3.25+ supports ALTER TABLE RENAME COLUMN natively
            if (Schema::hasColumn('users', 'staff_no')) {
                DB::statement('ALTER TABLE users RENAME COLUMN staff_no TO username');
            }
        } else {
            DB::statement('ALTER TABLE `users` CHANGE `staff_no` `username` VARCHAR(255) NULL');
        }
    }

    public function down()
    {
        if (DB::getDriverName() === 'sqlite') {
            if (Schema::hasColumn('users', 'username')) {
                DB::statement('ALTER TABLE users RENAME COLUMN username TO staff_no');
            }
        } else {
            DB::statement('ALTER TABLE `users` CHANGE `username` `staff_no` VARCHAR(255) NULL');
        }
    }
};
