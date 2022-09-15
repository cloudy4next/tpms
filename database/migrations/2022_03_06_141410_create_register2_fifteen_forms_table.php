<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegister2FifteenFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register2_fifteen_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->string('clname')->nullable();
            $table->date('dob')->nullable();
            $table->string('age')->nullable();
            $table->text('cldiag')->nullable();
            $table->text('insured')->nullable();
            $table->text('supname')->nullable();
            $table->text('regtech')->nullable();
            $table->date('sd')->nullable();
            $table->time('sst')->nullable();
            $table->time('set')->nullable();
            $table->integer('supprovide')->nullable();
            $table->integer('a_1')->nullable();
            $table->integer('a_2')->nullable();
            $table->integer('a_3')->nullable();
            $table->integer('a_4')->nullable();
            $table->integer('a_5')->nullable();
            $table->integer('a_6')->nullable();
            $table->integer('b_1')->nullable();
            $table->integer('b_2')->nullable();
            $table->integer('b_3')->nullable();
            $table->integer('c_1')->nullable();
            $table->integer('c_2')->nullable();
            $table->integer('c_3')->nullable();
            $table->integer('c_4')->nullable();
            $table->integer('c_5')->nullable();
            $table->integer('c_6')->nullable();
            $table->integer('c_7')->nullable();
            $table->integer('c_8')->nullable();
            $table->integer('c_9')->nullable();
            $table->integer('c_10')->nullable();
            $table->integer('c_11')->nullable();
            $table->integer('c_12')->nullable();
            $table->integer('d_1')->nullable();
            $table->integer('d_2')->nullable();
            $table->integer('d_3')->nullable();
            $table->integer('d_4')->nullable();
            $table->integer('d_5')->nullable();
            $table->integer('d_6')->nullable();
            $table->integer('e_1')->nullable();
            $table->integer('e_2')->nullable();
            $table->integer('e_3')->nullable();
            $table->integer('e_4')->nullable();
            $table->integer('e_5')->nullable();
            $table->integer('f_1')->nullable();
            $table->integer('f_2')->nullable();
            $table->integer('f_3')->nullable();
            $table->integer('f_4')->nullable();
            $table->integer('f_5')->nullable();     
            $table->text('supfeed')->nullable();     
            $table->text('supoverview')->nullable();     
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
        Schema::dropIfExists('register2_fifteen_forms');
    }
}
