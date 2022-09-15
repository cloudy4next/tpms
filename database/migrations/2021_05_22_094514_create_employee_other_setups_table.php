<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeOtherSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_other_setups', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->string('max_hour_per_day')->nullable();
            $table->string('max_hour_per_week')->nullable();
            $table->string('adp_employee_id')->nullable();
            $table->string('provider_level')->nullable();
            $table->string('custom_two')->nullable();
            $table->string('custom_three')->nullable();
            $table->string('custom_four')->nullable();
            $table->string('custom_five')->nullable();
            $table->string('custom_six')->nullable();
            $table->string('heigh_degree')->nullable();
            $table->string('degree_level')->nullable();
            $table->string('external_software_id')->nullable();
            $table->date('signature_valid_form')->nullable();
            $table->date('signature_valid_to')->nullable();
            $table->integer('signature_image')->nullable();
            $table->integer('paid_time_off')->nullable();
            $table->integer('exemt_staff')->nullable();
            $table->integer('gets_paid_holiday')->nullable();
            $table->integer('is_parttime')->nullable();
            $table->integer('is_contractor')->nullable();
            $table->integer('provider_render_without')->nullable();
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
        Schema::dropIfExists('employee_other_setups');
    }
}
