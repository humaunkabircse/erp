<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetDeprecationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_deprecations', function (Blueprint $table) {
            $table->id();
            $table->integer('asset_id');
            $table->date('asset_deprecation_date');
            $table->float('asset_deprecation_value');
            $table->longtext('asset_deprecation_note')->nullable();
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
        Schema::dropIfExists('asset_deprecations');
    }
}
