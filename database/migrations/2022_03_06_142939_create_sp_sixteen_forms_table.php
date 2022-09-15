<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpSixteenFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sp_sixteen_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->string('rec_name')->nullable();
            $table->string('ide')->nullable();
            $table->string('age')->nullable();
            $table->date('dob')->nullable();
            $table->string('gname')->nullable();
            $table->string('gcontact')->nullable();
            $table->string('address')->nullable();
            $table->string('comdate')->nullable();
            $table->string('auth')->nullable();
            $table->string('authname')->nullable();
            $table->string('bacbcer')->nullable();
            $table->string('npi')->nullable();
            $table->string('recdia')->nullable();
            $table->string('refer')->nullable();
            $table->string('phyname')->nullable();
            $table->string('phynpi')->nullable();
            $table->string('phycontact')->nullable();
            $table->string('intset')->nullable();
            $table->integer('radio1')->nullable();
            $table->text('bginfo')->nullable();
            $table->string('mdissue')->nullable();
            $table->string('resref')->nullable();
            $table->string('date1')->nullable();
            $table->string('ant1')->nullable();
            $table->string('beh1')->nullable();
            $table->string('con1')->nullable();
            $table->string('date2')->nullable();
            $table->string('ant2')->nullable();
            $table->string('beh2')->nullable();
            $table->string('con2')->nullable();
            $table->string('date3')->nullable();
            $table->string('ant3')->nullable();
            $table->string('beh3')->nullable();
            $table->string('con3')->nullable();

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
        Schema::dropIfExists('sp_sixteen_forms');
    }
}
