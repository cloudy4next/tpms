<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_statements', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('deposit_apply_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->date('service_date')->nullable();
            $table->integer('activity_id')->nullable();
            $table->float('co_pay')->nullable();
            $table->float('coins')->nullable();
            $table->float('ded')->nullable();
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
        Schema::dropIfExists('patient_statements');
    }
}
