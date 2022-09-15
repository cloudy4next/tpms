<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsThirty8FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_thirty8_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->string('pro14')->nullable();
            $table->string('tar14')->nullable();
            $table->string('b14_1')->nullable();
            $table->string('b14_2')->nullable();
            $table->string('b14_3')->nullable();
            $table->string('b14_4')->nullable();
            $table->string('b14_5')->nullable();
            $table->string('b14_6')->nullable();
            $table->string('b14_7')->nullable();
            $table->string('b14_8')->nullable();
            $table->string('b14_9')->nullable();
            $table->string('b14_10')->nullable();
            $table->string('b14_11')->nullable();
            $table->string('b14_12')->nullable();
            $table->string('b14_13')->nullable();
            $table->string('b14_14')->nullable();
            $table->string('b14_15')->nullable();
            $table->string('b14_t')->nullable();
            $table->string('b14_ot')->nullable();
            $table->string('b14_s')->nullable();

            $table->string('pro15')->nullable();
            $table->string('tar15')->nullable();
            $table->string('b15_1')->nullable();
            $table->string('b15_2')->nullable();
            $table->string('b15_3')->nullable();
            $table->string('b15_4')->nullable();
            $table->string('b15_5')->nullable();
            $table->string('b15_6')->nullable();
            $table->string('b15_7')->nullable();
            $table->string('b15_8')->nullable();
            $table->string('b15_9')->nullable();
            $table->string('b15_10')->nullable();
            $table->string('b15_11')->nullable();
            $table->string('b15_12')->nullable();
            $table->string('b15_13')->nullable();
            $table->string('b15_14')->nullable();
            $table->string('b15_15')->nullable();
            $table->string('b15_t')->nullable();
            $table->string('b15_ot')->nullable();
            $table->string('b15_s')->nullable();
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
        Schema::dropIfExists('ds_thirty8_forms');
    }
}
