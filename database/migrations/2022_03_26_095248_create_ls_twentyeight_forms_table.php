<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLsTwentyeightFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ls_twentyeight_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->string('clname')->nullable();
            $table->date('dob')->nullable();
            $table->string('icd')->nullable();
            $table->date('dos1')->nullable();
            $table->string('cpt1')->nullable();
            $table->text('stg1')->nullable();
            $table->text('apc1')->nullable();
            $table->date('dos2')->nullable();
            $table->string('cpt2')->nullable();
            $table->text('stg2')->nullable();
            $table->text('apc2')->nullable();
            $table->string('name1')->nullable();
            $table->string('name2')->nullable();
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
        Schema::dropIfExists('ls_twentyeight_forms');
    }
}
