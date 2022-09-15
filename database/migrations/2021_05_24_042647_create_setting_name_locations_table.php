<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingNameLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_name_locations', function (Blueprint $table) {
            $table->id();
            $table->string('facility_name')->nullable();
            $table->string('address')->nullable();
            $table->string('address_two')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone_one')->nullable();
            $table->string('phone_two')->nullable();
            $table->string('email')->nullable();
            $table->string('ein')->nullable();
            $table->string('npi')->nullable();
            $table->string('taxonomy_code')->nullable();
            $table->string('contact_person')->nullable();
            $table->integer('is_deafilt_facility')->nullable();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->string('service_area_miles')->nullable();
            $table->string('user_default_password')->nullable();
            $table->string('default_pos')->nullable();
            $table->text('message')->nullable();
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
        Schema::dropIfExists('setting_name_locations');
    }
}
