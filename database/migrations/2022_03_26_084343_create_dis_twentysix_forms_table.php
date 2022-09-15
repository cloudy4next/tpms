<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisTwentysixFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dis_twentysix_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->date('sdate')->nullable();
            $table->date('disdate')->nullable();
            $table->text('livsit')->nullable();
            $table->string('strength')->nullable();
            $table->string('needs')->nullable();
            $table->string('abilities')->nullable();
            $table->string('pref')->nullable();
            $table->text('incare')->nullable();
            $table->text('sigfind')->nullable();
            $table->text('summgoal')->nullable();
            $table->text('summnot')->nullable();
            $table->text('currss')->nullable();
            $table->text('overrec')->nullable();
            $table->text('outsideorg')->nullable();
            $table->text('planser')->nullable();
            $table->text('medneed')->nullable();
            $table->text('discont')->nullable();
            $table->text('summdis')->nullable();
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
        Schema::dropIfExists('dis_twentysix_forms');
    }
}
