<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterFourteenFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_fourteen_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->string('clname')->nullable();
            $table->date('dob')->nullable();
            $table->string('age')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('supname')->nullable();
            $table->string('regtech')->nullable();
            $table->date('sd')->nullable();
            $table->time('sst')->nullable();
            $table->time('set')->nullable();
            $table->integer('ptperson')->nullable();
            $table->integer('ptremote')->nullable();
            $table->text('supoverview')->nullable();
            $table->text('supfeed')->nullable();
            $table->string('pfn')->nullable();
            $table->string('pcred')->nullable();
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
        Schema::dropIfExists('register_fourteen_forms');
    }
}
