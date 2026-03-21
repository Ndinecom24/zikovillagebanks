<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('phone');
            $table->string('email');
            $table->string('address_line_1');
            $table->string('address_line');
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->string('tpin');
            $table->string('is_active');
            $table->string('created_by');
            $table->string('created_by_staff_no');
            $table->string('phone_area_code');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_details');
    }
}
