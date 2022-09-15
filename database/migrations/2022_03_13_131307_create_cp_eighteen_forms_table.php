<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCpEighteenFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cp_eighteen_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->text('clinicstatus')->nullable;
            $table->text('whopresent')->nullable;
            $table->text('behatarget')->nullable;
            $table->text('techused')->nullable;
            $table->text('programwork')->nullable;
            $table->text('reinforce')->nullable;
            $table->text('clientprogress')->nullable;
            $table->text('plannext')->nullable;
            $table->string('signature')->nullable;
            $table->string('updload_sign')->nullable;
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
        Schema::dropIfExists('cp_eighteen_forms');
    }
}
