<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE `users` CHANGE `staff_no` `username` VARCHAR(255) NULL');
    }

    public function down()
    {
        DB::statement('ALTER TABLE `users` CHANGE `username` `staff_no` VARCHAR(255) NULL');
    }
};
