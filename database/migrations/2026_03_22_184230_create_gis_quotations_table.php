<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGisQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gis_quotations', function (Blueprint $table) {
            $table->id();
            $table->string('quotation_no');
            $table->integer('client_id');
            $table->dateTime('quotation_date');
            $table->string('currency');
            $table->string('exchange_rate');
            $table->string('unit_desc');
            $table->string('quotation_final_kwacha');
            $table->string('quotation_final');
            $table->string('vat');
            $table->string('full_justification');
            $table->string('uuid');
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
        Schema::dropIfExists('gis_quotations');
    }
}
