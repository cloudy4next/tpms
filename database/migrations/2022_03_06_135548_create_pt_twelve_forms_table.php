<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePtTwelveFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pt_twelve_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->string('clname')->nullable();
            $table->date('dob')->nullable();
            $table->string('age')->nullable();
            $table->string('diag')->nullable();
            $table->string('insured')->nullable();
            $table->string('p_name')->nullable();
            $table->string('cred')->nullable();
            $table->string('caregiver')->nullable();
            $table->string('clname2')->nullable();
            $table->integer('bcbarad')->nullable();
            $table->text('otherexp')->nullable();
            $table->date('sd')->nullable();
            $table->time('sst')->nullable();
            $table->time('set')->nullable();
            $table->integer('in_person')->nullable();
            $table->integer('remote')->nullable();
            $table->text('pto')->nullable();
            $table->text('fd')->nullable();
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
        Schema::dropIfExists('pt_twelve_forms');
    }
}
