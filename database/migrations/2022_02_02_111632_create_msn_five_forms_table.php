<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsnFiveFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msn_five_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->string('clname')->nullable();
            $table->date('stdate')->nullable();
            $table->timestamp('sttime')->nullable();
            $table->string('rbts')->nullable();
            $table->integer('format1')->nullable();
            $table->integer('format2')->nullable();
            $table->integer('format3')->nullable();
            $table->integer('format4')->nullable();
            $table->integer('activities1')->nullable();
            $table->integer('activities2')->nullable();
            $table->integer('activities3')->nullable();
            $table->integer('activities4')->nullable();
            $table->text('goals')->nullable();
            $table->integer('responsetreat1')->nullable();
            $table->integer('responsetreat2')->nullable();
            $table->integer('responsetreat3')->nullable();
            $table->integer('responsetreat4')->nullable();
            $table->string('feed')->nullable();
            $table->string('pcondis')->nullable();
            $table->integer('rbt')->nullable();
            $table->string('rbt_exp')->nullable();
            $table->string('supervisorsign')->nullable();
            $table->string('supervisorname')->nullable();
            $table->date('signdate')->nullable();
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
        Schema::dropIfExists('msn_five_forms');
    }
}
