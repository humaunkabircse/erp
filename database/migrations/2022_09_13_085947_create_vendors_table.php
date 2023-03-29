<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_name');
            $table->string('vendor_contact_number');
            $table->string('vendor_description')->nullable();
            $table->string('vendor_company')->nullable();
            $table->string('vendor_vat_number')->nullable();
            $table->string('vendor_website')->nullable();
            $table->string('email')->nullable();
            $table->string('vendor_country');
            $table->string('vendor_district');
            $table->integer('vendor_zip')->nullable();
            $table->string('vendor_city')->nullable();
            $table->string('vendor_street')->nullable();
            $table->string('entered_by')->nullable();
            $table->date('date_entered')->nullable();
            $table->string('updated_by')->nullable();
            $table->date('date_updated')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
