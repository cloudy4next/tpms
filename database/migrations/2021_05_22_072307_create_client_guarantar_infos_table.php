<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientGuarantarInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_guarantar_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->string('guarantor_first_name')->nullable();
            $table->string('guarantor_last_name')->nullable();
            $table->date('guarantor_dob')->nullable();
            $table->string('guarantor_relationship')->nullable();
            $table->string('g_street')->nullable();
            $table->string('g_city')->nullable();
            $table->string('g_state')->nullable();
            $table->string('g_zip')->nullable();
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
        Schema::dropIfExists('client_guarantar_infos');
    }
}
