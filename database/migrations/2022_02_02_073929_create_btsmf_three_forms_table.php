<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBtsmfThreeFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('btsmf_three_forms', function (Blueprint $table) {
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
            $table->string('nohouri')->nullable();
            $table->string('nohs')->nullable();
            $table->text('top_feed')->nullable();
            $table->text('tlic')->nullable();
            $table->string('bacbidsing')->nullable();
            $table->string('bacbid')->nullable();
            $table->date('bacbiddate')->nullable();
            $table->string('bacbidsing2')->nullable();
            $table->string('bacbid2')->nullable();
            $table->date('bacbiddate2')->nullable();
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
        Schema::dropIfExists('btsmf_three_forms');
    }
}
