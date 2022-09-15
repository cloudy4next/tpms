<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_qualifications', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->string('qualification_name')->nullable();
            $table->date('qualification_date_issue')->nullable();
            $table->date('qualification_date_exp')->nullable();
            $table->text('qualification_file')->nullable();
            $table->integer('qualification_applicable')->nullable();
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
        Schema::dropIfExists('employee_qualifications');
    }
}
