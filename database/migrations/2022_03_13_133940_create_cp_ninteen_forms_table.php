<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCpNinteenFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cp_ninteen_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->text('subjective')->nullable();
            $table->text('objective')->nullable();
            $table->text('assessment')->nullable();
            $table->text('plan')->nullable();
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
        Schema::dropIfExists('cp_ninteen_forms');
    }
}
