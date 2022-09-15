<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBirpTwentyfive2FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('birp_twentyfive2_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->text('enc2')->nullable();
            $table->text('fomul2')->nullable();
            $table->text('ass2')->nullable();
            $table->text('reminded2')->nullable();
            $table->text('urged2')->nullable();
            $table->text('refer2')->nullable();
            $table->text('engage2')->nullable();
            $table->text('confirm2')->nullable();
            $table->text('resp2')->nullable();
            $table->text('direct2')->nullable();
            $table->text('arr2')->nullable();
            $table->text('assur2')->nullable();
            $table->text('resch2')->nullable();
            $table->text('enc3')->nullable();
            $table->text('ass3')->nullable();
            $table->text('formul3')->nullable();
            $table->text('reminded3')->nullable();
            $table->text('urged3')->nullable();
            $table->text('refer3')->nullable();
            $table->text('engage3')->nullable();
            $table->text('confirm3')->nullable();
            $table->text('resp3')->nullable();
            $table->text('direct3')->nullable();
            $table->text('arr3')->nullable();
            $table->text('assur3')->nullable();
            $table->text('resch3')->nullable();
            $table->text('enc4')->nullable();
            $table->text('formul4')->nullable();
            $table->text('ass4')->nullable();
            $table->text('reminded4')->nullable();
            $table->text('urged4')->nullable();
            $table->text('refer4')->nullable();
            $table->text('engage4')->nullable();
            $table->text('confirm4')->nullable();
            $table->text('resp4')->nullable();
            $table->text('direct4')->nullable();
            $table->text('arr4')->nullable();
            $table->text('assu4')->nullable();
            $table->text('resch4')->nullable();
            $table->text('strength')->nullable();
            $table->text('transitional')->nullable();
            $table->text('additional')->nullable();
            $table->string('statusselect')->nullable();
            $table->date('nextapp')->nullable();
            $table->string('signature')->nullable();
            $table->string('updload_sign')->nullable();
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
        Schema::dropIfExists('birp_twentyfive2_forms');
    }
}
