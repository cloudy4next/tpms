<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsThirty2FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_thirty2_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');

            $table->string('pro2')->nullable();
            $table->string('tar2')->nullable();
            $table->string('b2_1')->nullable();
            $table->string('b2_2')->nullable();
            $table->string('b2_3')->nullable();
            $table->string('b2_4')->nullable();
            $table->string('b2_5')->nullable();
            $table->string('b2_6')->nullable();
            $table->string('b2_7')->nullable();
            $table->string('b2_8')->nullable();
            $table->string('b2_9')->nullable();
            $table->string('b2_10')->nullable();
            $table->string('b2_11')->nullable();
            $table->string('b2_12')->nullable();
            $table->string('b2_13')->nullable();
            $table->string('b2_14')->nullable();
            $table->string('b2_15')->nullable();
            $table->string('b2_t')->nullable();
            $table->string('b2_ot')->nullable();
            $table->string('b2_s')->nullable();

            $table->string('pro3')->nullable();
            $table->string('tar3')->nullable();
            $table->string('b3_1')->nullable();
            $table->string('b3_2')->nullable();
            $table->string('b3_3')->nullable();
            $table->string('b3_4')->nullable();
            $table->string('b3_5')->nullable();
            $table->string('b3_6')->nullable();
            $table->string('b3_7')->nullable();
            $table->string('b3_8')->nullable();
            $table->string('b3_9')->nullable();
            $table->string('b3_10')->nullable();
            $table->string('b3_11')->nullable();
            $table->string('b3_12')->nullable();
            $table->string('b3_13')->nullable();
            $table->string('b3_14')->nullable();
            $table->string('b3_15')->nullable();
            $table->string('b3_t')->nullable();
            $table->string('b3_ot')->nullable();
            $table->string('b3_s')->nullable();
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
        Schema::dropIfExists('ds_thirty2_forms');
    }
}
