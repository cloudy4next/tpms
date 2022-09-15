<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_applies', function (Blueprint $table) {
            $table->id();
            $table->integer('batching_claim_id')->nullable();
            $table->date('dos')->nullable();
            $table->float('units')->nullable();
            $table->string('cpt')->nullable();
            $table->string('m1')->nullable();
            $table->string('m2')->nullable();
            $table->string('m3')->nullable();
            $table->string('m4')->nullable();
            $table->string('m5')->nullable();
            $table->float('amount')->nullable();
            $table->float('payment')->nullable();
            $table->float('adjustment')->nullable();
            $table->float('balance')->nullable();
            $table->string('reason')->nullable();
            $table->string('status')->nullable();
            $table->string('see_payor')->nullable();
            $table->integer('24j_provider')->nullable();
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
        Schema::dropIfExists('deposit_applies');
    }
}
