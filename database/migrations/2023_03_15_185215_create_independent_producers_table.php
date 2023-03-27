<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndependentProducersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('independent_producers', function (Blueprint $table) {
            $table->id();
            $table->string('system_ref');
            $table->string('invoiced_services')->nullable();
            $table->string('technology')->nullable();
            $table->string('engagement_number')->nullable();
            $table->string('name_of_ipp')->nullable();
            $table->dateTime('date_of_application')->nullable();
            $table->string('size_of_plant')->nullable();
            $table->string('size_of_plant_unit')->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('proposed_connection_point')->nullable();
            $table->string('total_system_generated')->nullable();
            $table->string('available_capacity')->nullable();
            $table->string('voltage_level')->nullable();
            $table->dateTime('date_of_connection')->nullable();
            $table->string('expiry_connection_point')->nullable();
            $table->string('status_of_engagement')->nullable();
            $table->string('updates_on_engagements')->nullable();
//            $table->string('doc_type')->nullable();
            $table->dateTime('date_of_update')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_email')->nullable();
            $table->string('contact_person_phone' )->nullable();
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
        Schema::dropIfExists('independent_producers');
    }
}
