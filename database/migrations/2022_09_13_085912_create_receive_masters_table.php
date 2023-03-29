<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiveMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receive_masters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rec_type_id');
            $table->unsignedBigInteger('vendor_id');
            $table->string('rec_invoice_number');
            $table->date('rec_date');
            $table->float('discount')->nullable()->default(0);
            $table->float('adjustment_qty')->nullable()->default(0);
            $table->string('rec_by');
            $table->longText('rec_note')->nullable();
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
        Schema::dropIfExists('receive_masters');
    }
}
