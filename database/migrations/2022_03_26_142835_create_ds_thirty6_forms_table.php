<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsThirty6FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_thirty6_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->text('session_note')->nullable();
            $table->string('pro10')->nullable();
            $table->string('tar10')->nullable();
            $table->string('b10_1')->nullable();
            $table->string('b10_2')->nullable();
            $table->string('b10_3')->nullable();
            $table->string('b10_4')->nullable();
            $table->string('b10_5')->nullable();
            $table->string('b10_6')->nullable();
            $table->string('b10_7')->nullable();
            $table->string('b10_8')->nullable();
            $table->string('b10_9')->nullable();
            $table->string('b10_10')->nullable();
            $table->string('b10_11')->nullable();
            $table->string('b10_12')->nullable();
            $table->string('b10_13')->nullable();
            $table->string('b10_14')->nullable();
            $table->string('b10_15')->nullable();
            $table->string('b10_t')->nullable();
            $table->string('b10_ot')->nullable();
            $table->string('b10_s')->nullable();

            $table->string('pro11')->nullable();
            $table->string('tar11')->nullable();
            $table->string('b11_1')->nullable();
            $table->string('b11_2')->nullable();
            $table->string('b11_3')->nullable();
            $table->string('b11_4')->nullable();
            $table->string('b11_5')->nullable();
            $table->string('b11_6')->nullable();
            $table->string('b11_7')->nullable();
            $table->string('b11_8')->nullable();
            $table->string('b11_9')->nullable();
            $table->string('b11_10')->nullable();
            $table->string('b11_11')->nullable();
            $table->string('b11_12')->nullable();
            $table->string('b11_13')->nullable();
            $table->string('b11_14')->nullable();
            $table->string('b11_15')->nullable();
            $table->string('b11_t')->nullable();
            $table->string('b11_ot')->nullable();
            $table->string('b11_s')->nullable();
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
        Schema::dropIfExists('ds_thirty6_forms');
    }
}
