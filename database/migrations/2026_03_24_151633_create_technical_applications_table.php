<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicalApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technical_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->string('project_name');
            $table->integer('province_id');
            $table->integer('connection_point_id');
            $table->integer('technology_id');
            $table->integer('district_id');
            $table->integer('proposed_generation_capacity');
            $table->integer('proposed_generation_capacity_units');
            $table->string('application_comments');
            $table->string('created_by');
            $table->string('created_by_staff_no');
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
        Schema::dropIfExists('technical_applications');
    }
}
