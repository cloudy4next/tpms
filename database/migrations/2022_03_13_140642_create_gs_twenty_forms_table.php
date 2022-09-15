<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGsTwentyFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gs_twenty_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->integer('task')->nullable();
            $table->text('assesstool')->nullable();
            $table->text('destask')->nullable();
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
        Schema::dropIfExists('gs_twenty_forms');
    }
}
