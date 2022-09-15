<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsThirty10FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_thirty10_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');

            $table->string('pro18')->nullable();
            $table->string('tar18')->nullable();
            $table->string('b18_1')->nullable();
            $table->string('b18_2')->nullable();
            $table->string('b18_3')->nullable();
            $table->string('b18_4')->nullable();
            $table->string('b18_5')->nullable();
            $table->string('b18_6')->nullable();
            $table->string('b18_7')->nullable();
            $table->string('b18_8')->nullable();
            $table->string('b18_9')->nullable();
            $table->string('b18_10')->nullable();
            $table->string('b18_11')->nullable();
            $table->string('b18_12')->nullable();
            $table->string('b18_13')->nullable();
            $table->string('b18_14')->nullable();
            $table->string('b18_15')->nullable();
            $table->string('b18_t')->nullable();
            $table->string('b18_ot')->nullable();
            $table->string('b18_s')->nullable();


            $table->string('task1')->nullable();
            $table->string('task2')->nullable();
            $table->string('task3')->nullable();

            $table->string('task1_1')->nullable();
            $table->string('task1_2')->nullable();
            $table->string('task1_3')->nullable();
            $table->string('task1_4')->nullable();
            $table->string('task1_5')->nullable();
            $table->string('task1_6')->nullable();
            $table->string('task1_7')->nullable();
            $table->string('task1_8')->nullable();
            $table->string('task1_9')->nullable();
            $table->string('task1_10')->nullable();

            $table->string('v1_1')->nullable();
            $table->string('v1_2')->nullable();
            $table->string('v1_3')->nullable();
            $table->string('v1_4')->nullable();
            $table->string('v1_5')->nullable();
            $table->string('v1_6')->nullable();
            $table->string('v1_7')->nullable();
            $table->string('v1_8')->nullable();
            $table->string('v1_9')->nullable();
            $table->string('v1_10')->nullable();
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
        Schema::dropIfExists('ds_thirty10_forms');
    }
}
