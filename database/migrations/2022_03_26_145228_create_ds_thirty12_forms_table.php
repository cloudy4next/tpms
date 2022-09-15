<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsThirty12FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_thirty12_forms', function (Blueprint $table) {
            $table->id();

            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->string('task1_t')->nullable();
            $table->string('task2_t')->nullable();
            $table->string('task3_t')->nullable();
            $table->string('ant1')->nullable();
            $table->string('beh1')->nullable();
            $table->string('con1')->nullable();
            $table->string('fun1')->nullable();
            $table->string('fre1')->nullable();

            $table->string('ant2')->nullable();
            $table->string('beh2')->nullable();
            $table->string('con2')->nullable();
            $table->string('fun2')->nullable();
            $table->string('fre2')->nullable();

            $table->string('ant3')->nullable();
            $table->string('beh3')->nullable();
            $table->string('con3')->nullable();
            $table->string('fun3')->nullable();
            $table->string('fre3')->nullable();
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
        Schema::dropIfExists('ds_thirty12_forms');
    }
}
