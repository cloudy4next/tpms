<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsThirty4FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_thirty4_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->string('pro6')->nullable();
            $table->string('tar6')->nullable();
            $table->string('b6_1')->nullable();
            $table->string('b6_2')->nullable();
            $table->string('b6_3')->nullable();
            $table->string('b6_4')->nullable();
            $table->string('b6_5')->nullable();
            $table->string('b6_6')->nullable();
            $table->string('b6_7')->nullable();
            $table->string('b6_8')->nullable();
            $table->string('b6_9')->nullable();
            $table->string('b6_10')->nullable();
            $table->string('b6_11')->nullable();
            $table->string('b6_12')->nullable();
            $table->string('b6_13')->nullable();
            $table->string('b6_14')->nullable();
            $table->string('b6_15')->nullable();
            $table->string('b6_t')->nullable();
            $table->string('b6_ot')->nullable();
            $table->string('b6_s')->nullable();

            $table->string('pro7')->nullable();
            $table->string('tar7')->nullable();
            $table->string('b7_1')->nullable();
            $table->string('b7_2')->nullable();
            $table->string('b7_3')->nullable();
            $table->string('b7_4')->nullable();
            $table->string('b7_5')->nullable();
            $table->string('b7_6')->nullable();
            $table->string('b7_7')->nullable();
            $table->string('b7_8')->nullable();
            $table->string('b7_9')->nullable();
            $table->string('b7_10')->nullable();
            $table->string('b7_11')->nullable();
            $table->string('b7_12')->nullable();
            $table->string('b7_13')->nullable();
            $table->string('b7_14')->nullable();
            $table->string('b7_15')->nullable();
            $table->string('b7_t')->nullable();
            $table->string('b7_ot')->nullable();
            $table->string('b7_s')->nullable();
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
        Schema::dropIfExists('ds_thirty4_forms');
    }
}
