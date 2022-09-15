<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppoinmentNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appoinment_notes', function (Blueprint $table) {
            $table->id();
            $table->integer('appoinment_id')->nullable();
            $table->string('client_name')->nullable();
            $table->date('note_date')->nullable();
            $table->integer('initial')->nullable();
            $table->integer('ongoing')->nullable();
            $table->text('goal1')->nullable();
            $table->date('goal1_odate')->nullable();
            $table->date('goal1_tdate')->nullable();
            $table->text('goal1_obj')->nullable();
            $table->text('goal1_int')->nullable();
            $table->text('goal2')->nullable();
            $table->date('goal2_odate')->nullable();
            $table->date('goal2_tdate')->nullable();
            $table->text('goal2_obj')->nullable();
            $table->text('goal2_int')->nullable();
            $table->text('goal3')->nullable();
            $table->date('goal3_odate')->nullable();
            $table->date('goal3_tdate')->nullable();
            $table->text('goal3_obj')->nullable();
            $table->text('goal3_int')->nullable();
            $table->text('goal4')->nullable();
            $table->date('goal4_odate')->nullable();
            $table->date('goal4_tdate')->nullable();
            $table->text('goal4_obj')->nullable();
            $table->text('goal4_int')->nullable();
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
        Schema::dropIfExists('appoinment_notes');
    }
}
