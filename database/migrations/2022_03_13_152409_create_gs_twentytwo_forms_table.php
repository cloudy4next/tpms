<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGsTwentytwoFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gs_twentytwo_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->integer('defict')->nullable();
            $table->text('pbo')->nullable();
            $table->text('iu')->nullable();
            $table->text('pn')->nullable();
            $table->text('fpt')->nullable();
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
        Schema::dropIfExists('gs_twentytwo_forms');
    }
}
