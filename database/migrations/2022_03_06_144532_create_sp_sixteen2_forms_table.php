<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpSixteen2FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sp_sixteen2_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->string('medn1')->nullable();
            $table->string('dos1')->nullable();
            $table->string('pur1')->nullable();
            $table->string('side1')->nullable();
            $table->string('medn2')->nullable();
            $table->string('dos2')->nullable();
            $table->string('pur2')->nullable();
            $table->string('side2')->nullable();
            $table->string('medn3')->nullable();
            $table->string('dos3')->nullable();
            $table->string('pur3')->nullable();
            $table->string('side3')->nullable();
            $table->string('beh')->nullable();
            $table->string('func')->nullable();
            $table->string('bline')->nullable();
            $table->string('inten')->nullable();
            $table->string('datam')->nullable();
            $table->string('patid')->nullable();
            $table->string('blang')->nullable();
            $table->text('goal1')->nullable();
            $table->text('goal2')->nullable();
            $table->text('goal3')->nullable();
            $table->text('gtrain')->nullable();
            $table->text('tgbgoal')->nullable();
            $table->string('contextant')->nullable();
            $table->string('behv')->nullable();
            $table->string('funccon')->nullable();
            $table->string('consq')->nullable();
            $table->string('preventst')->nullable();
            $table->string('repskills')->nullable();
            $table->string('managest')->nullable();
            $table->string('ltstat')->nullable();
            $table->string('ltobj')->nullable();
            $table->string('interobj')->nullable();
            $table->string('tarbeh')->nullable();
            $table->string('stobj')->nullable();
            $table->string('mes')->nullable();
            $table->string('sttatus')->nullable();
            $table->string('baselevel')->nullable();
            $table->string('clevel')->nullable();
            $table->string('mcriteria')->nullable();
            $table->string('act')->nullable();
            $table->string('drink')->nullable();
            $table->string('games')->nullable();
            $table->string('social')->nullable();
            $table->string('risk')->nullable();
            $table->string('notes')->nullable();
            $table->string('benefit')->nullable();
            $table->string('nott')->nullable();
            $table->string('genez')->nullable();
            $table->string('maint')->nullable();
            $table->string('actstep1')->nullable();
            $table->string('crit1')->nullable();
            $table->string('tframe1')->nullable();
            $table->string('srba1')->nullable();
            $table->string('srbas1')->nullable();
            $table->string('nlct1')->nullable();
            $table->string('desc1')->nullable();
            $table->string('actstep2')->nullable();
            $table->string('crit2')->nullable();
            $table->string('tframe2')->nullable();
            $table->string('srba2')->nullable();
            $table->string('srbas2')->nullable();
            $table->string('nlct2')->nullable();
            $table->string('desc2')->nullable();
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
        Schema::dropIfExists('sp_sixteen2_forms');
    }
}
