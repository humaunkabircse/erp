<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatePassMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gate_pass_masters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cus_id');
            $table->string('gp_number');
            $table->date('gp_date');
            $table->string('gp_type');
            $table->longText('gp_note')->nullable();
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
        Schema::dropIfExists('get_pass_masters');
    }
}
