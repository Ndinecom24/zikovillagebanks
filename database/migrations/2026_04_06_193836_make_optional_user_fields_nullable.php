<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MakeOptionalUserFieldsNullable extends Migration
{
    public function up()
    {
        // On SQLite all columns are already nullable by default in our schema,
        // so this migration only needs to run on MySQL.
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement('ALTER TABLE `users` MODIFY `job_title` VARCHAR(255) NULL');
        DB::statement('ALTER TABLE `users` MODIFY `user_unit` VARCHAR(255) NULL');
        DB::statement('ALTER TABLE `users` MODIFY `directorate` VARCHAR(255) NULL');
        DB::statement('ALTER TABLE `users` MODIFY `user_role_id` VARCHAR(255) NULL');
        DB::statement('ALTER TABLE `users` MODIFY `usertype` INT NULL');
    }

    public function down()
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement("ALTER TABLE `users` MODIFY `job_title` VARCHAR(255) NOT NULL DEFAULT ''");
        DB::statement("ALTER TABLE `users` MODIFY `user_unit` VARCHAR(255) NOT NULL DEFAULT ''");
        DB::statement("ALTER TABLE `users` MODIFY `directorate` VARCHAR(255) NOT NULL DEFAULT ''");
        DB::statement("ALTER TABLE `users` MODIFY `user_role_id` VARCHAR(255) NOT NULL DEFAULT ''");
        DB::statement("ALTER TABLE `users` MODIFY `usertype` INT NOT NULL DEFAULT 0");
    }
}
