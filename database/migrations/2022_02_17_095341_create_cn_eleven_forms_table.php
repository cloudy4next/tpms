<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCnElevenFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cn_eleven_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->string('clname')->nullable();
            $table->date('stdate')->nullable();
            $table->string('terp')->nullable();
            $table->timestamp('sttitme')->nullable();
            $table->timestamp('endtime')->nullable();
            $table->text('notes')->nullable();
            $table->string('location')->nullable();
            $table->date('lodate')->nullable();
            $table->timestamp('losttime')->nullable();
            $table->timestamp('loendtime')->nullable();
            $table->string('los')->nullable();
            $table->integer('spyn')->nullable();
            $table->integer('cpins')->nullable();
            $table->string('suds')->nullable();
            $table->string('twods')->nullable();
            $table->string('wnmbwo')->nullable();
            $table->string('iopdb')->nullable();
            $table->string('note2')->nullable();
            $table->string('ladd')->nullable();
            $table->text('signature')->nullable();
            $table->text('updload_sign')->nullable();
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
        Schema::dropIfExists('cn_eleven_forms');
    }
}
