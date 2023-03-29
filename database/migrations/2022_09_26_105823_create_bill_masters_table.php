<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_masters', function (Blueprint $table) {
            $table->id();
            $table->string('bill_number');
            $table->date('bill_date');
            $table->integer('invoice_id');
            $table->longText('bill_note')->nullable();
            $table->integer('entered_by')->nullable();
            $table->date('date_entered')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('bill_masters');
    }
}
