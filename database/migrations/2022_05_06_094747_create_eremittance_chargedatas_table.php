<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEremittanceChargedatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eremittance_chargedatas', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('eremit_check_id')->nullable();
            $table->integer('eremit_visitpay_id')->nullable();
            $table->string('charge_control_number')->nullable();
            $table->date('service_date')->nullable();
            $table->string('cpt')->nullable();
            $table->float('submitted_amount')->nullable();
            $table->float('paid_amount')->nullable();
            $table->float('copay_amount')->nullable();
            $table->float('ded_amount')->nullable();
            $table->float('coins_amount')->nullable();
            $table->string('other_adj_code_one')->nullable();
            $table->float('other_adj_amt_one')->nullable();
            $table->string('other_adj_code_two')->nullable();
            $table->float('other_adj_amt_two')->nullable();
            $table->string('remark_one')->nullable();
            $table->string('remark_two')->nullable();
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
        Schema::dropIfExists('eremittance_chargedatas');
    }
}
