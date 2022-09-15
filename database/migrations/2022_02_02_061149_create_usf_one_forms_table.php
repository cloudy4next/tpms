<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsfOneFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usf_one_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->string('tr_name')->nullable();
            $table->timestamp('starttm')->nullable();
            $table->date('stdate')->nullable();
            $table->string('supervisor')->nullable();
            $table->timestamp('endtime')->nullable();
            $table->string('exptyp')->nullable();
            $table->string('stgname')->nullable();
            $table->integer('actcat')->nullable();
            $table->text('actnote')->nullable();
            $table->timestamp('tlhrs')->nullable();
            $table->string('tlcon')->nullable();
            $table->string('individual')->nullable();
            $table->string('group2')->nullable();
            $table->string('traineewithclnt')->nullable();
            $table->integer('formate')->nullable();
            $table->string('experience2')->nullable();
            $table->integer('supervisiontype')->nullable();
            $table->integer('actcat2')->nullable();
            $table->string('bsttask')->nullable();
            $table->text('sumsup')->nullable();
            $table->text('supfeed')->nullable();
            $table->string('actitem')->nullable();
            $table->string('bcbaid')->nullable();
            $table->date('signdate')->nullable();
            $table->string('bacbid2')->nullable();
            $table->date('signdate2')->nullable();
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
        Schema::dropIfExists('usf_one_forms');
    }
}
