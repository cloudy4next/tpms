<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientAuthorizationActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_authorization_activities', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->text('activity_name')->nullable();
            $table->integer('authorization_id')->nullable();
            $table->text('activity_one')->nullable();
            $table->text('activity_two')->nullable();
            $table->text('cpt_code')->nullable();
            $table->text('m1')->nullable();
            $table->text('m2')->nullable();
            $table->text('m3')->nullable();
            $table->text('m4')->nullable();
            $table->text('auth_activity')->nullable();
            $table->text('billed_type')->nullable();
            $table->text('billed_time')->nullable();
            $table->text('rate')->nullable();
            $table->text('hours_max_one')->nullable();
            $table->text('hours_max_per_one')->nullable();
            $table->text('hours_max_is_one')->nullable();
            $table->text('hours_max_two')->nullable();
            $table->text('hours_max_per_two')->nullable();
            $table->text('hours_max_is_two')->nullable();
            $table->text('hours_max_three')->nullable();
            $table->text('hours_max_per_three')->nullable();
            $table->text('hours_max_is_three')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('client_authorization_activities');
    }
}
