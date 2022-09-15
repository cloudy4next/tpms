<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiaTwentynineFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dia_twentynine_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->string('clname')->nullable();
            $table->date('dob')->nullable();
            $table->date('date')->nullable();
            $table->string('icd')->nullable();
            $table->text('reason')->nullable();
            $table->text('testadmin')->nullable();
            $table->text('scores')->nullable();
            $table->text('implication')->nullable();
            $table->text('recom')->nullable();
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
        Schema::dropIfExists('dia_twentynine_forms');
    }
}
