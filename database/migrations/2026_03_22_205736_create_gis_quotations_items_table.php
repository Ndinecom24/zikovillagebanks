<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGisQuotationsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gis_quotations_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quotation_id');
            $table->string('description');
            $table->string('quantity');
            $table->string('unit_price');
            $table->string('total');
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
        Schema::dropIfExists('gis_quotations_items');
    }
}
