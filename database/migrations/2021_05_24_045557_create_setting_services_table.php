<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_services', function (Blueprint $table) {
            $table->id();
            $table->string('service')->nullable();
            $table->string('description')->nullable();
            $table->string('rate')->nullable();
            $table->string('duration')->nullable();
            $table->integer('make_default')->nullable();
            $table->integer('bill_in_unit')->nullable();
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
        Schema::dropIfExists('setting_services');
    }
}
