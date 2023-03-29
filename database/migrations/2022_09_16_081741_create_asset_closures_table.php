<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetClosuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_closures', function (Blueprint $table) {
            $table->id();
            $table->integer('asset_id');
            $table->date('asset_closure_date');
            $table->string('asset_closure_reason');
            $table->longtext('asset_closure_note')->nullable();
            $table->integer('entered_by')->nullable();
            $table->date('date_entered')->nullable();
            $table->integer('updated_by')->nullable();
            $table->date('date_updated')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('asset_closures');
    }
}
