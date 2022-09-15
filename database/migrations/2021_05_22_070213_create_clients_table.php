<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->integer('is_active_client')->nullable();
            $table->integer('client_type')->nullable();
            $table->string('client_first_name')->nullable();
            $table->string('client_middle')->nullable();
            $table->string('client_last_name')->nullable();
            $table->string('client_suffix')->nullable();
            $table->string('client_preferred')->nullable();
            $table->string('client_gender')->nullable();
            $table->date('client_dob')->nullable();
            $table->string('email')->nullable();
            $table->string('email_type')->nullable();
            $table->string('email_reminder')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('phone_type')->nullable();
            $table->integer('is_send_sms')->nullable();
            $table->integer('is_voice_sms')->nullable();
            $table->string('location')->nullable();
            $table->string('zone')->nullable();
            $table->string('client_street')->nullable();
            $table->string('client_city')->nullable();
            $table->string('client_state')->nullable();
            $table->string('client_zip')->nullable();
            $table->string('supervisor_name')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
