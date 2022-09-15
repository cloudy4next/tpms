<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTcsnFixFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcsn_fix_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->integer('clname')->nullable();
            $table->date('stdate')->nullable();
            $table->timestamp('sttime')->nullable();
            $table->timestamp('endtime')->nullable();
            $table->integer('setting1')->nullable();
            $table->integer('setting2')->nullable();
            $table->integer('setting3')->nullable();
            $table->integer('pepresent1')->nullable();
            $table->integer('pepresent2')->nullable();
            $table->integer('pepresent3')->nullable();
            $table->integer('pepresent4')->nullable();
            $table->integer('pepresent5')->nullable();
            $table->integer('pepresent6')->nullable();
            $table->string('pepresentiotr')->nullable();
            $table->integer('dangerousbehave1')->nullable();
            $table->integer('dangerousbehave2')->nullable();
            $table->integer('dangerousbehave3')->nullable();
            $table->integer('dangerousbehave4')->nullable();
            $table->integer('dangerousbehave5')->nullable();
            $table->integer('dangerousbehave6')->nullable();
            $table->integer('dangerousbehave7')->nullable();
            $table->string('dangerousbehaveotr')->nullable();
            $table->integer('chabehaviors')->nullable();
            $table->integer('dtt')->nullable();
            $table->integer('net')->nullable();
            $table->integer('mt')->nullable();
            $table->integer('ta')->nullable();
            $table->integer('bip')->nullable();
            $table->integer('shaping')->nullable();
            $table->integer('bst')->nullable();
            $table->integer('iuotrcheck')->nullable();
            $table->string('iuotrchecktxt')->nullable();
            $table->integer('prarcom')->nullable();
            $table->integer('proarpair')->nullable();
            $table->integer('proarscoial')->nullable();
            $table->integer('proarsc')->nullable();
            $table->integer('proarpsk')->nullable();
            $table->integer('proarflu')->nullable();
            $table->integer('proartnc')->nullable();
            $table->integer('proarsmr')->nullable();
            $table->integer('proarotr')->nullable();
            $table->string('proarotrtxt')->nullable();
            $table->integer('ensession1')->nullable();
            $table->integer('ensession2')->nullable();
            $table->integer('ensession3')->nullable();
            $table->integer('ensession4')->nullable();
            $table->integer('ensession5')->nullable();
            $table->text('motivating')->nullable();
            $table->text('well')->nullable();
            $table->text('struggle')->nullable();
            $table->text('help')->nullable();
            $table->integer('supsession1')->nullable();
            $table->integer('supsession2')->nullable();
            $table->integer('supsession3')->nullable();
            $table->integer('supsession4')->nullable();
            $table->text('thcomts')->nullable();
            $table->string('thersign1')->nullable();
            $table->string('priame1')->nullable();
            $table->date('thersigndate1')->nullable();
            $table->integer('pcqrbt')->nullable();
            $table->text('pcqrbtexp')->nullable();
            $table->string('thersign2')->nullable();
            $table->string('prname2')->nullable();
            $table->date('thersigndate2')->nullable();
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
        Schema::dropIfExists('tcsn_fix_forms');
    }
}
