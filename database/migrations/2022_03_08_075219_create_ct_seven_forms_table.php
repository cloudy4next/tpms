<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCtSevenFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ct_seven_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->string('clname')->nullable();
            $table->date('date')->nullable();
            $table->time('stime')->nullable();
            $table->time('etime')->nullable();
            $table->integer('setting')->nullable();
            $table->integer('community')->nullable();
            $table->integer('clinic')->nullable();
            $table->integer('school')->nullable();
            $table->integer('langimp')->nullable();
            $table->integer('explang')->nullable();
            $table->integer('ssdef')->nullable();
            $table->integer('repbeh')->nullable();
            $table->integer('resint')->nullable();
            $table->integer('hyper')->nullable();
            $table->integer('insist')->nullable();
            $table->integer('harmself')->nullable();
            $table->integer('report')->nullable();
            $table->integer('brc')->nullable();
            $table->integer('mag')->nullable();
            $table->integer('bmg')->nullable();
            $table->integer('mac')->nullable();
            $table->integer('mpg')->nullable();
            $table->integer('mrs')->nullable();
            $table->integer('mmg')->nullable();
            $table->integer('mtt')->nullable();
            $table->integer('ptr')->nullable();
            $table->integer('asskill')->nullable();
            $table->integer('intobs')->nullable();
            $table->integer('othdes')->nullable();
            $table->text('othdesexp')->nullable();
            $table->integer('lcomm')->nullable();
            $table->integer('ttp')->nullable();
            $table->integer('socskill')->nullable();
            $table->integer('playskill')->nullable();
            $table->integer('adapskill')->nullable();
            $table->integer('selfman')->nullable();
            $table->integer('motoskill')->nullable();
            $table->integer('tarsafe')->nullable();
            $table->integer('disrupt')->nullable();
            $table->integer('taroth')->nullable();
            $table->text('tarothdes')->nullable();
            $table->integer('dtt')->nullable();
            $table->integer('net')->nullable();
            $table->integer('vb')->nullable();
            $table->integer('shaping')->nullable();
            $table->integer('chaining')->nullable();
            $table->integer('bst')->nullable();
            $table->integer('incteach')->nullable();
            $table->integer('propmt')->nullable();
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
        Schema::dropIfExists('ct_seven_forms');
    }
}
