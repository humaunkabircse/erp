<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact_number');
            $table->string('description');
            $table->string('cus_company');
            $table->string('vat_number');
            $table->string('cus_website')->nullable();
            $table->string('email')->nullable();

            $table->enum('status',['active','inactive'])->default('active');

            $table->string('country');
            $table->string('district');
            $table->integer('zip');
            $table->string('city');
            $table->string('street');

            $table->string('billing_country')->nullable();
            $table->string('billing_district')->nullable();
            $table->integer('billing_zip')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_street')->nullable();

            $table->string('shipping_country')->nullable();
            $table->string('shipping_district')->nullable();
            $table->integer('shipping_zip')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_street')->nullable();

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
        Schema::dropIfExists('customers');
    }
}
