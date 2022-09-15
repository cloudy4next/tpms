<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPortalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_portals', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->integer('self_schedule_appoinment')->nullable();
            $table->integer('secure_message')->nullable();
            $table->integer('access_billing')->nullable();
            $table->integer('pay_stripe')->nullable();
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
        Schema::dropIfExists('client_portals');
    }
}
