<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllPayorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_payor_details', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('payor_id')->nullable();
            $table->integer('facility_payor_id')->nullable();
            $table->string('payor_name')->nullable();
            $table->string('co_pay')->nullable();
            $table->integer('day_club')->nullable();
            $table->integer('is_electronic')->nullable();
            $table->string('cms_1500_31')->nullable();
            $table->string('cms_1500_32a')->nullable();
            $table->string('cms_1500_32b')->nullable();
            $table->string('cms_1500_33a')->nullable();
            $table->string('cms_1500_33b')->nullable();
            $table->integer('is_active')->nullable();
            $table->string('npi')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('ssn')->nullable();
            $table->string('box_17')->nullable();
            $table->text('cms150032_address')->nullable();
            $table->text('cms150033_address')->nullable();
            $table->integer('day_pay_cpt')->nullable();
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
        Schema::dropIfExists('all_payor_details');
    }
}
