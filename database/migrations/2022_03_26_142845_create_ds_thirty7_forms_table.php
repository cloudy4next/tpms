<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsThirty7FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_thirty7_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');

            $table->string('pro12')->nullable();
            $table->string('tar12')->nullable();
            $table->string('b12_1')->nullable();
            $table->string('b12_2')->nullable();
            $table->string('b12_3')->nullable();
            $table->string('b12_4')->nullable();
            $table->string('b12_5')->nullable();
            $table->string('b12_6')->nullable();
            $table->string('b12_7')->nullable();
            $table->string('b12_8')->nullable();
            $table->string('b12_9')->nullable();
            $table->string('b12_10')->nullable();
            $table->string('b12_11')->nullable();
            $table->string('b12_12')->nullable();
            $table->string('b12_13')->nullable();
            $table->string('b12_14')->nullable();
            $table->string('b12_15')->nullable();
            $table->string('b12_t')->nullable();
            $table->string('b12_ot')->nullable();
            $table->string('b12_s')->nullable();

            $table->string('pro13')->nullable();
            $table->string('tar13')->nullable();
            $table->string('b13_1')->nullable();
            $table->string('b13_2')->nullable();
            $table->string('b13_3')->nullable();
            $table->string('b13_4')->nullable();
            $table->string('b13_5')->nullable();
            $table->string('b13_6')->nullable();
            $table->string('b13_7')->nullable();
            $table->string('b13_8')->nullable();
            $table->string('b13_9')->nullable();
            $table->string('b13_10')->nullable();
            $table->string('b13_11')->nullable();
            $table->string('b13_12')->nullable();
            $table->string('b13_13')->nullable();
            $table->string('b13_14')->nullable();
            $table->string('b13_15')->nullable();
            $table->string('b13_t')->nullable();
            $table->string('b13_ot')->nullable();
            $table->string('b13_s')->nullable();
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
        Schema::dropIfExists('ds_thirty7_forms');
    }
}
