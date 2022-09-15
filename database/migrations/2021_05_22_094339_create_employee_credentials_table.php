<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_credentials', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->string('credential_name')->nullable();
            $table->date('credential_date_issue')->nullable();
            $table->date('credential_date_expired')->nullable();
            $table->text('credential_file')->nullable();
            $table->integer('credential_applicable')->nullable();
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
        Schema::dropIfExists('employee_credentials');
    }
}
