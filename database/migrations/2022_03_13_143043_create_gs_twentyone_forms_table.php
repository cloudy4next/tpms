<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGsTwentyoneFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gs_twentyone_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->integer('parti')->nullable();
            $table->text('recm')->nullable();
            $table->text('goaladdress')->nullable();
            $table->text('intervent')->nullable();
            $table->text('feedback')->nullable();
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
        Schema::dropIfExists('gs_twentyone_forms');
    }
}
