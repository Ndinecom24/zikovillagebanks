<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectionPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connection_points', function (Blueprint $table) {
            $table->id();
            $table->string('district_id');
            $table->string('substation');
            $table->string('voltage_level');
            $table->string('layout');
            $table->string('firm_capacity')->nullable();
            $table->string('installed_capacity');
            $table->string('substation_capacity')->nullable();
            $table->string('status_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('connection_points');
    }
}
