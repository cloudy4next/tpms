<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEremittanceVisitpaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eremittance_visitpays', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->string('patient_control_number')->nullable();
            $table->string('payor_control_number')->nullable();
            $table->float('submitted_amount')->nullable();
            $table->float('paid_amount')->nullable();
            $table->float('pat_respon_am')->nullable();
            $table->float('copay_am')->nullable();
            $table->float('ded_am')->nullable();
            $table->float('cocoins_am')->nullable();
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
        Schema::dropIfExists('eremittance_visitpays');
    }
}
