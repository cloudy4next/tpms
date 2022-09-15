<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('payor_id')->nullable();
            $table->string('treatment_type')->nullable();
            $table->string('activity_type')->nullable();
            $table->string('sub_activity')->nullable();
            $table->integer('cpt_code')->nullable();
            $table->string('m1')->nullable();
            $table->string('m2')->nullable();
            $table->string('m3')->nullable();
            $table->string('m4')->nullable();
            $table->string('rate_per')->nullable();
            $table->float('contracted_rate')->nullable();
            $table->float('billed_rate')->nullable();
            $table->float('increasing_percentage')->nullable();
            $table->integer('active')->nullable();
            $table->integer('add_auth')->nullable();
            $table->string('degree_level')->nullable();
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
        Schema::dropIfExists('rate_lists');
    }
}
