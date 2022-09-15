<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->integer('payor_type')->nullable();
            $table->integer('payor_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->date('deposit_date')->nullable();
            $table->integer('payment_method')->nullable();
            $table->string('instrument')->nullable();
            $table->date('instrument_date')->nullable();
            $table->float('amount')->nullable();
            $table->text('file')->nullable();
            $table->float('unapplied_amount')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('deposits');
    }
}
