<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_masters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cus_id');
            $table->foreign('cus_id')->references('id')->on('invoice_masters');
            $table->string('invoice_number');
            $table->date('invoice_date');
            $table->date('invoice_due_date')->nullable();
            $table->float('discount')->nullable()->default(0);
            $table->float('adjustment')->nullable()->default(0);
            $table->longText('client_note')->nullable();
            $table->longText('terms_and_conditions')->nullable();
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
        Schema::dropIfExists('invoice_masters');
    }
}
