<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBomDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bom_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bom_master_id');
            $table->foreign('bom_master_id')->references('id')->on('bom_details');
            $table->unsignedBigInteger('used_item_id');
            $table->foreign('used_item_id')->references('id')->on('bom_details');
            $table->integer('used_item_qty');
            $table->string('used_item_unit');
            $table->float('wastage_quantity');
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
        Schema::dropIfExists('bom_details');
    }
}
