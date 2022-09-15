<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('appointment_id')->nullable();
            $table->date('schedule_date')->nullable();
            $table->string('timein_one')->nullable();
            $table->string('timein_two')->nullable();
            $table->string('timein_three')->nullable();
            $table->string('timeout_one')->nullable();
            $table->string('timeout_two')->nullable();
            $table->string('timeout_three')->nullable();
            $table->float('hours')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('activity_id')->nullable();
            $table->float('miles')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('timesheets');
    }
}
