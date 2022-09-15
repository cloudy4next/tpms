<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEremittanceCheckdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eremittance_checkdatas', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->date('check_date')->nullable();
            $table->string('check_number')->nullable();
            $table->float('check_amount')->nullable();
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
        Schema::dropIfExists('eremittance_checkdatas');
    }
}
