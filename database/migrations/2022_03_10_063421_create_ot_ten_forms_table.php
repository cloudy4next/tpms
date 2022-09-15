<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtTenFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ot_ten_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->text('riskharm')->nullable();
            $table->text('funcstatus')->nullable();
            $table->text('comorbid')->nullable();
            $table->text('envstress')->nullable();
            $table->text('suppenv')->nullable();
            $table->text('rescurr')->nullable();
            $table->text('acceng')->nullable();
            $table->text('transp')->nullable();
            $table->text('present')->nullable();
            $table->text('currtreat')->nullable();
            $table->text('detail30')->nullable();
            $table->text('currmed')->nullable();
            $table->text('treat')->nullable();
            $table->string('signature')->nullable();
            $table->string('updload_sign')->nullable();
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
        Schema::dropIfExists('ot_ten_forms');
    }
}
