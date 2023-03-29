<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_registers', function (Blueprint $table) {
            $table->id();
            $table->string('asset_name');
            $table->integer('asset_type');
            $table->date('asset_purshase_date');
            $table->string('asset_origin');
            $table->float('asset_price');
            $table->longtext('asset_note')->nullable();
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
        Schema::dropIfExists('asset_registers');
    }
}
