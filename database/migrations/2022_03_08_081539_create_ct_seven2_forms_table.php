<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCtSeven2FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ct_seven2_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->integer('antec')->nullable();
            $table->integer('pnrein')->nullable();
            $table->integer('tokenecon')->nullable();
            $table->integer('diffrein')->nullable();
            $table->integer('nonharm')->nullable();
            $table->integer('tuother')->nullable();
            $table->text('tuotherdes')->nullable();
            $table->integer('absbeh')->nullable();
            $table->integer('decbeh')->nullable();
            $table->integer('mastar')->nullable();
            $table->integer('masgoal')->nullable();
            $table->integer('maingoal')->nullable();
            $table->integer('rapidgoal')->nullable();
            $table->integer('steadygoal')->nullable();
            $table->integer('incbeh')->nullable();
            $table->integer('behplan')->nullable();
            $table->integer('lackmot')->nullable();
            $table->integer('regresskill')->nullable();
            $table->text('tpdetail')->nullable();
            $table->text('newbeh')->nullable();
            $table->text('ptdiss')->nullable();
            $table->text('followup')->nullable();
            $table->integer('inperson')->nullable();
            $table->integer('remote')->nullable();
            $table->integer('group')->nullable();
            $table->text('obsnote')->nullable();
            $table->integer('datreview')->nullable();
            $table->integer('observation')->nullable();
            $table->integer('protdemon')->nullable();
            $table->integer('teammeeting')->nullable();
            $table->integer('datother')->nullable();
            $table->text('datotherexp')->nullable();
            $table->text('posfeed')->nullable();
            $table->text('teach')->nullable();
            $table->text('moddel')->nullable();
            $table->text('coach')->nullable();
            $table->text('review')->nullable();
            $table->integer('ioa')->nullable();
            $table->text('dttsheet')->nullable();
            $table->text('goal1')->nullable();
            $table->text('goal2')->nullable();
            $table->text('goal3')->nullable();
            $table->string('parsign')->nullable();
            $table->string('parprint')->nullable();
            $table->date('pardate')->nullable();
            $table->string('pmsign')->nullable();
            $table->string('pmprint')->nullable();
            $table->date('pmdate')->nullable();
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
        Schema::dropIfExists('ct_seven2_forms');
    }
}
