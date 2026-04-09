<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MakeOptionalUserFieldsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `users` MODIFY `job_title` VARCHAR(255) NULL');
        DB::statement('ALTER TABLE `users` MODIFY `user_unit` VARCHAR(255) NULL');
        DB::statement('ALTER TABLE `users` MODIFY `directorate` VARCHAR(255) NULL');
        DB::statement('ALTER TABLE `users` MODIFY `user_role_id` VARCHAR(255) NULL');
        DB::statement('ALTER TABLE `users` MODIFY `usertype` INT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `users` MODIFY `job_title` VARCHAR(255) NOT NULL DEFAULT ''");
        DB::statement("ALTER TABLE `users` MODIFY `user_unit` VARCHAR(255) NOT NULL DEFAULT ''");
        DB::statement("ALTER TABLE `users` MODIFY `directorate` VARCHAR(255) NOT NULL DEFAULT ''");
        DB::statement("ALTER TABLE `users` MODIFY `user_role_id` VARCHAR(255) NOT NULL DEFAULT ''");
        DB::statement("ALTER TABLE `users` MODIFY `usertype` INT NOT NULL DEFAULT 0");
    }
}
