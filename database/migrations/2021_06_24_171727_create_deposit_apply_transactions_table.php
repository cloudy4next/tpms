<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositApplyTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_apply_transactions', function (Blueprint $table) {
            $table->id();
            $table->date('dos')->nullable();
            $table->string('code')->nullable();
            $table->string('m1')->nullable();
            $table->float('amount')->nullable();
            $table->float('payment')->nullable();
            $table->float('adjustment')->nullable();
            $table->string('reason')->nullable();
            $table->string('status')->nullable();
            $table->string('m2')->nullable();
            $table->string('m3')->nullable();
            $table->string('m4')->nullable();
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
        Schema::dropIfExists('deposit_apply_transactions');
    }
}
