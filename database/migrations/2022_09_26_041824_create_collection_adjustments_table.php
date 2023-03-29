<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_adjustments', function (Blueprint $table) {
            $table->id();
            $table->string('collection_adjustment_number');
            $table->unsignedBigInteger('cus_id');
            $table->foreign('cus_id')->references('id')->on('collection_adjustments');
            $table->date('collection_adjustment_date');
            $table->float('collection_adjustment_amount');
            $table->longText('collection_adjustment_purpose')->nullable();
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
        Schema::dropIfExists('collection_adjustments');
    }
}
