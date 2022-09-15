<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsThirty9FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_thirty9_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');

            $table->string('pro16')->nullable();
            $table->string('tar16')->nullable();
            $table->string('b16_1')->nullable();
            $table->string('b16_2')->nullable();
            $table->string('b16_3')->nullable();
            $table->string('b16_4')->nullable();
            $table->string('b16_5')->nullable();
            $table->string('b16_6')->nullable();
            $table->string('b16_7')->nullable();
            $table->string('b16_8')->nullable();
            $table->string('b16_9')->nullable();
            $table->string('b16_10')->nullable();
            $table->string('b16_11')->nullable();
            $table->string('b16_12')->nullable();
            $table->string('b16_13')->nullable();
            $table->string('b16_14')->nullable();
            $table->string('b16_15')->nullable();
            $table->string('b16_t')->nullable();
            $table->string('b16_ot')->nullable();
            $table->string('b16_s')->nullable();

            $table->string('pro17')->nullable();
            $table->string('tar17')->nullable();
            $table->string('b17_1')->nullable();
            $table->string('b17_2')->nullable();
            $table->string('b17_3')->nullable();
            $table->string('b17_4')->nullable();
            $table->string('b17_5')->nullable();
            $table->string('b17_6')->nullable();
            $table->string('b17_7')->nullable();
            $table->string('b17_8')->nullable();
            $table->string('b17_9')->nullable();
            $table->string('b17_10')->nullable();
            $table->string('b17_11')->nullable();
            $table->string('b17_12')->nullable();
            $table->string('b17_13')->nullable();
            $table->string('b17_14')->nullable();
            $table->string('b17_15')->nullable();
            $table->string('b17_t')->nullable();
            $table->string('b17_ot')->nullable();
            $table->string('b17_s')->nullable();
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
        Schema::dropIfExists('ds_thirty9_forms');
    }
}
