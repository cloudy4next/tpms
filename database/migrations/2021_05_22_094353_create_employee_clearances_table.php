<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeClearancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_clearances', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->string('clearance_name')->nullable();
            $table->date('clearance_date_issue')->nullable();
            $table->date('clearance_date_exp')->nullable();
            $table->text('clearance_file')->nullable();
            $table->integer('clearance_applicable')->nullable();
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
        Schema::dropIfExists('employee_clearances');
    }
}
