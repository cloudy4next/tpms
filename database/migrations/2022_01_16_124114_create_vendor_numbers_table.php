<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_numbers', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('service_id');
            $table->integer('treatment_id');
            $table->string('vendor_no');
            $table->string('service_code');
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
        Schema::dropIfExists('vendor_numbers');
    }
}
