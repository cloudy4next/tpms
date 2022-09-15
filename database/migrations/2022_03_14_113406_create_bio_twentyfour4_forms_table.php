<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBioTwentyfour4FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_twentyfour4_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->integer('atthost')->nullable();
            $table->integer('attneg')->nullable();
            $table->integer('attpass')->nullable();
            $table->integer('attaggr')->nullable();
            $table->integer('attsedu')->nullable();
            $table->text('attitudecomm')->nullable();
            $table->text('medhistory')->nullable();
            $table->text('medcond')->nullable();
            $table->text('contactinfo')->nullable();
            $table->date('lastdate')->nullable();
            $table->integer('immunizations')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->integer('satisfied')->nullable();
            $table->integer('diagnosed')->nullable();
            $table->integer('referral')->nullable();
            $table->string('med')->nullable();
            $table->string('dosage')->nullable();
            $table->string('effect')->nullable();
            $table->string('compli')->nullable();
            $table->string('prescrr')->nullable();
            $table->string('medname')->nullable();
            $table->string('dosefreq')->nullable();
            $table->string('effective')->nullable();
            $table->string('compl')->nullable();
            $table->string('presby')->nullable();
            $table->string('med3')->nullable();
            $table->string('freq3')->nullable();
            $table->string('effect3')->nullable();
            $table->string('compl3')->nullable();
            $table->string('pres3')->nullable();
            $table->string('med4')->nullable();
            $table->string('freq4')->nullable();
            $table->string('effect4')->nullable();
            $table->string('compl4')->nullable();
            $table->string('pres4')->nullable();
            $table->string('med5')->nullable();
            $table->string('freq5')->nullable();
            $table->string('effect5')->nullable();
            $table->string('compl5')->nullable();
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
        Schema::dropIfExists('bio_twentyfour4_forms');
    }
}
