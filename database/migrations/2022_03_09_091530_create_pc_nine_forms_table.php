<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcNineFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_nine_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->string('clname')->nullable();
            $table->date('dob')->nullable();
            $table->date('doa')->nullable();
            $table->string('poa')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('insid')->nullable();
            $table->string('school')->nullable();
            $table->string('grade')->nullable();
            $table->text('intersum')->nullable();
            $table->integer('psyserv')->nullable();
            $table->integer('prepsy')->nullable();
            $table->string('prename')->nullable();
            $table->integer('psymed')->nullable();
            $table->text('preslist')->nullable();
            $table->text('presby')->nullable();
            $table->integer('priphy')->nullable();
            $table->string('priphone')->nullable();
            $table->integer('mtomed')->nullable();
            $table->text('mtolist')->nullable();
            $table->text('lastphy')->nullable();
            $table->text('hconc')->nullable();
            $table->text('currmed')->nullable();
            $table->integer('sleephab')->nullable();
            $table->integer('sleepcheck')->nullable();
            $table->string('wexc')->nullable();
            $table->string('exclong')->nullable();
            $table->integer('ehabit')->nullable();
            $table->integer('ehabitcheck')->nullable();
            $table->integer('wchange')->nullable();
            $table->integer('usealc')->nullable();
            $table->integer('drinkp')->nullable();
            $table->integer('recdrug')->nullable();
            $table->integer('cigar')->nullable();
            $table->integer('suith')->nullable();
            $table->integer('suipast')->nullable();
            $table->integer('romrel')->nullable();
            $table->string('rellong')->nullable();
            $table->text('relrate')->nullable();
            $table->text('lastchange')->nullable();
            $table->integer('depress')->nullable();
            $table->integer('mood')->nullable();
            $table->integer('rapids')->nullable();
            $table->integer('extanx')->nullable();
            $table->integer('panatt')->nullable();
            $table->integer('phob')->nullable();
            $table->integer('sleepdis')->nullable();
            $table->integer('hallu')->nullable();
            $table->integer('unlosstime')->nullable();
            $table->integer('unexmemory')->nullable();
            $table->integer('alabuse')->nullable();
            $table->integer('freqcomp')->nullable();
            $table->integer('eatdiss')->nullable();
            $table->integer('bodyimg')->nullable();
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
        Schema::dropIfExists('pc_nine_forms');
    }
}
