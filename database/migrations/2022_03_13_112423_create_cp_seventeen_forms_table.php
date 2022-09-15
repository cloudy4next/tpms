<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCpSeventeenFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cp_seventeen_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->text('currstatus')->nullable();
            $table->text('goaltarget')->nullable();
            $table->text('goaladdress')->nullable();
            $table->text('techattempt')->nullable();
            $table->text('restreat')->nullable();
            $table->text('progressdata')->nullable();
            $table->string('lengthsup')->nullable();
            $table->string('rendbehtech')->nullable();
            $table->string('superprovide')->nullable();
            $table->string('feedbackcrit')->nullable();
            $table->integer('client')->nullable();
            $table->integer('therapist')->nullable();
            $table->integer('render_prov')->nullable();
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
        Schema::dropIfExists('cp_seventeen_forms');
    }
}
