<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_type')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('nickname')->nullable();
            $table->date('staff_birthday')->nullable();
            $table->string('ssn')->nullable();
            $table->string('staff_other_id')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('office_fax')->nullable();
            $table->string('office_email')->nullable();
            $table->string('driver_license')->nullable();
            $table->date('license_exp_date')->nullable();
            $table->string('title')->nullable();
            $table->date('hir_date_compnay')->nullable();
            $table->string('credential_type')->nullable();
            $table->string('treatment_type')->nullable();
            $table->string('individual_npi')->nullable();
            $table->string('caqh_id')->nullable();
            $table->string('service_area_zip')->nullable();
            $table->date('terminated_date')->nullable();
            $table->string('language')->nullable();
            $table->string('taxonomy_code')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('military_service')->nullable();
            $table->integer('therapist_bill')->nullable();
            $table->integer('is_staff_active')->nullable();
            $table->integer('enable_fource_creation')->nullable();
            $table->integer('has_catalsty_access')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
