<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_claims', function (Blueprint $table) {
            $table->id();
            $table->string('batch_id')->nullable();
            $table->integer('appointment_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('provider_id')->nullable();
            $table->integer('activity_id')->nullable();
            $table->integer('payor_id')->nullable();
            $table->integer('activity_type')->nullable();
            $table->date('schedule_date')->nullable();
            $table->string('cpt')->nullable();
            $table->string('m1')->nullable();
            $table->string('m2')->nullable();
            $table->string('m3')->nullable();
            $table->string('m4')->nullable();
            $table->string('pos')->nullable();
            $table->string('units')->nullable();
            $table->string('rate')->nullable();
            $table->string('cms_24j')->nullable();
            $table->string('id_qualifier')->nullable();
            $table->string('status')->nullable();
            $table->string('degree_level')->nullable();
            $table->string('zone')->nullable();
            $table->string('location')->nullable();
            $table->float('units_value_calc')->nullable();
            $table->float('billed_am')->nullable();
            $table->date('billed_date')->nullable();
            $table->integer('is_mark_gen')->nullable();
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
        Schema::dropIfExists('manage_claims');
    }
}
