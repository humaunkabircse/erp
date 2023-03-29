<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cus_id')->nullable();
            $table->string('pay_mode');
            $table->string('cheque_no')->nullable();
            $table->date('cheque_date')->nullable();
            $table->integer('bank_name_id')->nullable();
            $table->date('pay_date');
            $table->integer('pay_receive_by');
            $table->float('pay_amount');
            $table->longText('pay_note')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
