<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsptnTwoFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsptn_two_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->string('childname')->nullable();
            $table->string('attendens')->nullable();
            $table->timestamp('starttime')->nullable();
            $table->timestamp('endtime')->nullable();
            $table->date('stdate')->nullable();
            $table->integer('goals1')->nullable();
            $table->integer('goals2')->nullable();
            $table->integer('goals3')->nullable();
            $table->integer('goals4')->nullable();
            $table->integer('goals5')->nullable();
            $table->integer('goals6')->nullable();
            $table->text('act')->nullable();
            $table->text('needs')->nullable();
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
        Schema::dropIfExists('dsptn_two_forms');
    }
}
