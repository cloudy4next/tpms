<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer("admin_id");
            $table->string("user_name")->nullable();
            $table->string("marital")->nullable();
            $table->string("age")->nullable();
            $table->string("city")->nullable();
            $table->string("country")->nullable();
            $table->string("state")->nullable();
            $table->string("address")->nullable();
            $table->string("profile_photo")->nullable();
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
        Schema::dropIfExists('admin_profiles');
    }
}
