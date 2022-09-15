<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsThirty5FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_thirty5_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->string('pro8')->nullable();
            $table->string('tar8')->nullable();
            $table->string('b8_1')->nullable();
            $table->string('b8_2')->nullable();
            $table->string('b8_3')->nullable();
            $table->string('b8_4')->nullable();
            $table->string('b8_5')->nullable();
            $table->string('b8_6')->nullable();
            $table->string('b8_7')->nullable();
            $table->string('b8_8')->nullable();
            $table->string('b8_9')->nullable();
            $table->string('b8_10')->nullable();
            $table->string('b8_11')->nullable();
            $table->string('b8_12')->nullable();
            $table->string('b8_13')->nullable();
            $table->string('b8_14')->nullable();
            $table->string('b8_15')->nullable();
            $table->string('b8_t')->nullable();
            $table->string('b8_ot')->nullable();
            $table->string('b8_s')->nullable();

            $table->string('pro9')->nullable();
            $table->string('tar9')->nullable();
            $table->string('b9_1')->nullable();
            $table->string('b9_2')->nullable();
            $table->string('b9_3')->nullable();
            $table->string('b9_4')->nullable();
            $table->string('b9_5')->nullable();
            $table->string('b9_6')->nullable();
            $table->string('b9_7')->nullable();
            $table->string('b9_8')->nullable();
            $table->string('b9_9')->nullable();
            $table->string('b9_10')->nullable();
            $table->string('b9_11')->nullable();
            $table->string('b9_12')->nullable();
            $table->string('b9_13')->nullable();
            $table->string('b9_14')->nullable();
            $table->string('b9_15')->nullable();
            $table->string('b9_t')->nullable();
            $table->string('b9_ot')->nullable();
            $table->string('b9_s')->nullable();
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
        Schema::dropIfExists('ds_thirty5_forms');
    }
}
