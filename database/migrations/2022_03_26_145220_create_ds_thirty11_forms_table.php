<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsThirty11FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_thirty11_forms', function (Blueprint $table) {
            $table->id();

            $table->integer('admin_id');
            $table->integer('sessionid');

            $table->string('task2_1')->nullable();
            $table->string('task2_2')->nullable();
            $table->string('task2_3')->nullable();
            $table->string('task2_4')->nullable();
            $table->string('task2_5')->nullable();
            $table->string('task2_6')->nullable();
            $table->string('task2_7')->nullable();
            $table->string('task2_8')->nullable();
            $table->string('task2_9')->nullable();
            $table->string('task2_10')->nullable();

            $table->string('v2_1')->nullable();
            $table->string('v2_2')->nullable();
            $table->string('v2_3')->nullable();
            $table->string('v2_4')->nullable();
            $table->string('v2_5')->nullable();
            $table->string('v2_6')->nullable();
            $table->string('v2_7')->nullable();
            $table->string('v2_8')->nullable();
            $table->string('v2_9')->nullable();
            $table->string('v2_10')->nullable();

            $table->string('task3_1')->nullable();
            $table->string('task3_2')->nullable();
            $table->string('task3_3')->nullable();
            $table->string('task3_4')->nullable();
            $table->string('task3_5')->nullable();
            $table->string('task3_6')->nullable();
            $table->string('task3_7')->nullable();
            $table->string('task3_8')->nullable();
            $table->string('task3_9')->nullable();
            $table->string('task3_10')->nullable();

            $table->string('v3_1')->nullable();
            $table->string('v3_2')->nullable();
            $table->string('v3_3')->nullable();
            $table->string('v3_4')->nullable();
            $table->string('v3_5')->nullable();
            $table->string('v3_6')->nullable();
            $table->string('v3_7')->nullable();
            $table->string('v3_8')->nullable();
            $table->string('v3_9')->nullable();
            $table->string('v3_10')->nullable();
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
        Schema::dropIfExists('ds_thirty11_forms');
    }
}
