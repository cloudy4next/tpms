<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecurringSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurring_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_name')->nullable();
            $table->string('client_name')->nullable();
            $table->string('activity_name')->nullable();
            $table->string('provider_name')->nullable();
            $table->string('location')->nullable();
            $table->date('schedule_date_start')->nullable();
            $table->date('schedule_date_end')->nullable();
            $table->timestamp('horus_form')->nullable();
            $table->timestamp('horus_to')->nullable();
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
        Schema::dropIfExists('recurring_sessions');
    }
}
