<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_masters', function (Blueprint $table) {
            $table->id();
            $table->string('batch_number');
            $table->date('production_date');
            $table->integer('item_id');
            $table->unsignedBigInteger('prod_qty');
            $table->foreign('prod_qty')->references('id')->on('production_masters');
            $table->float('item_price');
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
        Schema::dropIfExists('production_masters');
    }
}
