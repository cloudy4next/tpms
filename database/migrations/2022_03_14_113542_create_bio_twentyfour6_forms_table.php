<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBioTwentyfour6FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_twentyfour6_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->time('sptime')->nullable();
            $table->string('fptxt')->nullable();
            $table->time('fptime')->nullable();
            $table->string('indetxt')->nullable();
            $table->time('indetime')->nullable();
            $table->string('othr')->nullable();
            $table->string('othtxt')->nullable();
            $table->time('othtime')->nullable();
            $table->text('idensymp')->nullable();
            $table->text('summarycons')->nullable();
            $table->text('cghfuture')->nullable();
            $table->text('likeyour')->nullable();
            $table->text('likeimprove')->nullable();
            $table->text('proudlife')->nullable();
            $table->text('expectpart')->nullable();
            $table->text('strength')->nullable();
            $table->text('needs')->nullable();
            $table->text('abilities')->nullable();
            $table->text('prefer')->nullable();
            $table->text('problemlist')->nullable();
            $table->text('diagrational')->nullable();
            $table->text('intersumm')->nullable();
            $table->integer('rscomm')->nullable();
            $table->integer('rsmed')->nullable();
            $table->integer('rsind')->nullable();
            $table->integer('rsfam')->nullable();
            $table->integer('rstesting')->nullable();
            $table->integer('rscare')->nullable();
            $table->integer('rsbtl')->nullable();
            $table->integer('rscoll')->nullable();
            $table->integer('rsreha')->nullable();
            $table->integer('rsasoc')->nullable();
            $table->integer('rsltt')->nullable();
            $table->integer('rsgrou')->nullable();
            $table->integer('rsother')->nullable();
            $table->text('referrall')->nullable();
            $table->text('whichhospital')->nullable();
            $table->text('dsmv')->nullable();
            $table->text('rectreat')->nullable();
            $table->date('projectdate')->nullable();
            $table->text('clarea')->nullable();
            $table->text('dischplan')->nullable();
            $table->string('signature');
            $table->string('updload_sign');
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
        Schema::dropIfExists('bio_twentyfour6_forms');
    }
}
