<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsThirty3FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_thirty3_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');

            $table->string('pro4')->nullable();
            $table->string('tar4')->nullable();
            $table->string('b4_1')->nullable();
            $table->string('b4_2')->nullable();
            $table->string('b4_3')->nullable();
            $table->string('b4_4')->nullable();
            $table->string('b4_5')->nullable();
            $table->string('b4_6')->nullable();
            $table->string('b4_7')->nullable();
            $table->string('b4_8')->nullable();
            $table->string('b4_9')->nullable();
            $table->string('b4_10')->nullable();
            $table->string('b4_11')->nullable();
            $table->string('b4_12')->nullable();
            $table->string('b4_13')->nullable();
            $table->string('b4_14')->nullable();
            $table->string('b4_15')->nullable();
            $table->string('b4_t')->nullable();
            $table->string('b4_ot')->nullable();
            $table->string('b4_s')->nullable();

            $table->string('pro5')->nullable();
            $table->string('tar5')->nullable();
            $table->string('b5_1')->nullable();
            $table->string('b5_2')->nullable();
            $table->string('b5_3')->nullable();
            $table->string('b5_4')->nullable();
            $table->string('b5_5')->nullable();
            $table->string('b5_6')->nullable();
            $table->string('b5_7')->nullable();
            $table->string('b5_8')->nullable();
            $table->string('b5_9')->nullable();
            $table->string('b5_10')->nullable();
            $table->string('b5_11')->nullable();
            $table->string('b5_12')->nullable();
            $table->string('b5_13')->nullable();
            $table->string('b5_14')->nullable();
            $table->string('b5_15')->nullable();
            $table->string('b5_t')->nullable();
            $table->string('b5_ot')->nullable();
            $table->string('b5_s')->nullable();
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
        Schema::dropIfExists('ds_thirty3_forms');
    }
}
