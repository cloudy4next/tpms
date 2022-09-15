<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLproTwentysevenFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lpro_twentyseven_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->string('clname')->nullable();
            $table->string('dob')->nullable();
            $table->string('address')->nullable();
            $table->date('sdate')->nullable();
            $table->string('cpt')->nullable();
            $table->string('ca')->nullable();
            $table->string('icd')->nullable();
            $table->text('backinfo')->nullable();
            $table->text('ltgoal')->nullable();
            $table->text('stgoal')->nullable();
            $table->text('intstra')->nullable();
            $table->text('resth')->nullable();
            $table->text('testsem')->nullable();
            $table->text('recom')->nullable();
            $table->text('mednec')->nullable();
            $table->text('recomm')->nullable();
            $table->text('ltgoal2')->nullable();
            $table->text('stgoal2')->nullable();
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
        Schema::dropIfExists('lpro_twentyseven_forms');
    }
}
