<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBioTwentyfourFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_twentyfour_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->text('presentprob')->nullable();
            $table->text('history')->nullable();
            $table->text('riskharm')->nullable();
            $table->text('trauma')->nullable();
            $table->text('comorbid')->nullable();
            $table->text('environ')->nullable();
            $table->text('defictsupport')->nullable();
            $table->text('transportation')->nullable();
            $table->text('clientrequest')->nullable();
            $table->text('prenatal')->nullable();
            $table->text('health')->nullable();
            $table->text('devmile')->nullable();
            $table->text('specialserv')->nullable();
            $table->text('otherlife')->nullable();
            $table->string('attending')->nullable();
            $table->string('grade')->nullable();
            $table->text('expell')->nullable();
            $table->integer('absences')->nullable();
            $table->integer('retained')->nullable();
            $table->integer('classes')->nullable();
            $table->text('pastpsy')->nullable();
            $table->text('physical')->nullable();
            $table->text('substance')->nullable();
            $table->text('present')->nullable();
            $table->text('outcome')->nullable();
            $table->text('pastsupport')->nullable();
            $table->text('otherprovider')->nullable();
            $table->integer('lhistinfo')->nullable();
            $table->integer('lhistwel')->nullable();
            $table->integer('lhistrestrain')->nullable();
            $table->integer('lhistformal')->nullable();
            $table->integer('lhistconserv')->nullable();
            $table->integer('lhistnone')->nullable();
            $table->integer('lhistparole')->nullable();
            $table->integer('lhistdui')->nullable();
            $table->text('probationoff')->nullable();
            $table->integer('ssubstance')->nullable();
            $table->integer('caffeine')->nullable();
            $table->integer('prescr')->nullable();
            $table->integer('halluc')->nullable();
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
        Schema::dropIfExists('bio_twentyfour_forms');
    }
}
