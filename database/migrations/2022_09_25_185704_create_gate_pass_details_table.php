<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatePassDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gate_pass_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gp_id');
            $table->unsignedBigInteger('item_id');
            $table->float('item_qty')->nullable()->default(0);
            $table->float('item_price')->nullable()->default(0);
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
        Schema::dropIfExists('gate_pass_details');
    }
}
