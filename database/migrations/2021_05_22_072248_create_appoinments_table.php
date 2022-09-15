<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppoinmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appoinments', function (Blueprint $table) {
            $table->id();
            $table->integer('recurring_id')->nullable();
            $table->integer('billable')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('authorization_id')->nullable();
            $table->integer('authorization_activity_id')->nullable();
            $table->integer('payor_id')->nullable();
            $table->integer('provider_id')->nullable();
            $table->string('location')->nullable();
            $table->integer('time_duration')->nullable();
            $table->timestamp('from_time')->nullable();
            $table->string('activity_type')->nullable();
            $table->timestamp('to_time')->nullable();
            $table->string('cpt_code')->nullable();
            $table->date('schedule_date')->nullable();
            $table->string('status')->nullable();
            $table->text('notes')->nullable();
            $table->string('m1')->nullable();
            $table->string('m2')->nullable();
            $table->string('m3')->nullable();
            $table->string('m4')->nullable();
            $table->date('weekly_date')->nullable();
            $table->string('week_day_name')->nullable();
            $table->string('degree_level')->nullable();
            $table->string('gender')->nullable();
            $table->string('zone')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('lagunage')->nullable();
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
        Schema::dropIfExists('appoinments');
    }
}
