<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('village_bank_configurations', function (Blueprint $table) {
            $table->decimal('share_unit_amount', 12, 2)->default(200.00)->after('circle_duration_months');
            $table->unsignedInteger('min_shares_per_month')->default(1)->after('share_unit_amount');
            $table->unsignedInteger('max_shares_per_month')->default(50)->after('min_shares_per_month');
        });
    }

    public function down()
    {
        Schema::table('village_bank_configurations', function (Blueprint $table) {
            $table->dropColumn(['share_unit_amount', 'min_shares_per_month', 'max_shares_per_month']);
        });
    }
};
