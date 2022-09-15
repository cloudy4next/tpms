<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTpEightFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tp_eight_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->string('clname')->nullable();
            $table->date('stdate')->nullable();
            $table->integer('init')->nullable();
            $table->integer('ongoing')->nullable();
            $table->string('gl1')->nullable();
            $table->date('gl1opendt')->nullable();
            $table->date('gl1trdat')->nullable();
            $table->text('gl1obj')->nullable();
            $table->text('gl1inter')->nullable();
            $table->string('gl2')->nullable();
            $table->date('gl2opdt')->nullable();
            $table->date('gl2trdt')->nullable();
            $table->text('gl2obj')->nullable();
            $table->text('gl2inter')->nullable();
            $table->string('gl3')->nullable();
            $table->date('gl3opdt')->nullable();
            $table->date('gl3trdt')->nullable();
            $table->text('gl3obj')->nullable();
            $table->text('gl3inter')->nullable();
            $table->string('gl4')->nullable();
            $table->date('gl4opdt')->nullable();
            $table->date('gl4trdt')->nullable();
            $table->text('gl4obj')->nullable();
            $table->text('gl4inter')->nullable();
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
        Schema::dropIfExists('tp_eight_forms');
    }
}
