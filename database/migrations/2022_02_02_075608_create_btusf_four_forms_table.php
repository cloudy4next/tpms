<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBtusfFourFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('btusf_four_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->date('stdate')->nullable();
            $table->string('sttime')->nullable();
            $table->string('trainee')->nullable();
            $table->string('restricthours')->nullable();
            $table->string('setting')->nullable();
            $table->string('numclient')->nullable();
            $table->string('cpurchaging')->nullable();
            $table->string('unrestricthours')->nullable();
            $table->string('supervisingbcba')->nullable();
            $table->string('bcba')->nullable();
            $table->string('seslength')->nullable();
            $table->string('nohs')->nullable();
            $table->integer('suptypes1')->nullable();
            $table->integer('suptypes2')->nullable();
            $table->integer('suptypes3')->nullable();
            $table->integer('arotime')->nullable();
            $table->integer('coworkers')->nullable();
            $table->integer('selfimprovement')->nullable();
            $table->integer('appropriately')->nullable();
            $table->integer('seeks')->nullable();
            $table->integer('submission')->nullable();
            $table->integer('communicates')->nullable();
            $table->integer('sensitivity')->nullable();
            $table->integer('behanalytic')->nullable();
            $table->text('feeds')->nullable();
            $table->text('tlic')->nullable();
            $table->string('bacbsign')->nullable();
            $table->string('bacb')->nullable();
            $table->date('bacbdate')->nullable();
            $table->string('bacbsign2')->nullable();
            $table->string('bacb2')->nullable();
            $table->date('bacbdate2')->nullable();
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
        Schema::dropIfExists('btusf_four_forms');
    }
}
