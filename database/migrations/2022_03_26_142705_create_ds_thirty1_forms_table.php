<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsThirty1FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_thirty1_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->string('clname')->nullable();
            $table->string('stname')->nullable();
            $table->date('sdate')->nullable();
            $table->time('sttime')->nullable();
            $table->time('etime')->nullable();
            $table->string('select1')->nullable();
            $table->string('select2')->nullable();
            $table->string('hour1')->nullable();
            $table->string('hr1_1')->nullable();
            $table->string('hr2_1')->nullable();
            $table->string('hr3_1')->nullable();
            $table->string('total_1')->nullable();
            $table->string('hour2')->nullable();
            $table->string('hr1_2')->nullable();
            $table->string('hr2_2')->nullable();
            $table->string('hr3_2')->nullable();
            $table->string('total_2')->nullable();
            $table->string('hour3')->nullable();
            $table->string('hr1_3')->nullable();
            $table->string('hr2_3')->nullable();
            $table->string('hr3_3')->nullable();
            $table->string('total_3')->nullable();
            
            $table->string('pro1')->nullable();
            $table->string('tar1')->nullable();
            $table->string('b1_1')->nullable();
            $table->string('b1_2')->nullable();
            $table->string('b1_3')->nullable();
            $table->string('b1_4')->nullable();
            $table->string('b1_5')->nullable();
            $table->string('b1_6')->nullable();
            $table->string('b1_7')->nullable();
            $table->string('b1_8')->nullable();
            $table->string('b1_9')->nullable();
            $table->string('b1_10')->nullable();
            $table->string('b1_11')->nullable();
            $table->string('b1_12')->nullable();
            $table->string('b1_13')->nullable();
            $table->string('b1_14')->nullable();
            $table->string('b1_15')->nullable();
            $table->string('b1_t')->nullable();
            $table->string('b1_ot')->nullable();
            $table->string('b1_s')->nullable();

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
        Schema::dropIfExists('ds_thirty1_forms');
    }
}
