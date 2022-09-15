<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnThirteenFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sn_thirteen_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->string('clname')->nullable();
            $table->date('sd')->nullable();
            $table->time('stime')->nullable();
            $table->time('etime')->nullable();
            $table->string('units')->nullable();
            $table->string('sl')->nullable();
            $table->string('pxcode')->nullable();
            $table->string('scd')->nullable();
            $table->string('on')->nullable();
            $table->string('pname')->nullable();
            $table->string('pcr')->nullable();
            $table->string('pnpi')->nullable();
            $table->integer('skill')->nullable();
            $table->integer('social')->nullable();
            $table->integer('role')->nullable();
            $table->integer('prem')->nullable();
            $table->integer('stimu')->nullable();
            $table->integer('modeling')->nullable();
            $table->integer('shaping')->nullable();
            $table->integer('contract')->nullable();
            $table->integer('timer')->nullable();
            $table->integer('tboard')->nullable();
            $table->integer('selfm')->nullable();
            $table->integer('dtt')->nullable();
            $table->integer('antm')->nullable();
            $table->integer('selfmn')->nullable();
            $table->integer('diffrein')->nullable();
            $table->integer('fct')->nullable();
            $table->integer('vaid')->nullable();
            $table->integer('errorlearn')->nullable();
            $table->integer('net')->nullable();
            $table->integer('chaining')->nullable();
            $table->integer('others')->nullable();
            $table->string('other2')->nullable();
            $table->string('stype')->nullable();
            $table->text('sessionnotes')->nullable();
            $table->text('ssummary')->nullable();
            $table->string('provider_name')->nullable();
            $table->string('pcredent')->nullable();
            $table->string('signature')->nullable();
            $table->string('updload_sign')->nullable();
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
        Schema::dropIfExists('sn_thirteen_forms');
    }
}
