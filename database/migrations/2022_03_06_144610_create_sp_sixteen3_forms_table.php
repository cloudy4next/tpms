<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpSixteen3FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sp_sixteen3_forms', function (Blueprint $table) {
            $table->id();
            $table->string('admin_id')->nullable();
            $table->string('sessionid')->nullable();
            $table->string('actstep3')->nullable();
            $table->string('crit3')->nullable();
            $table->string('tframe3')->nullable();
            $table->string('srba3')->nullable();
            $table->string('srbas3')->nullable();
            $table->string('nlct3')->nullable();
            $table->string('desc3')->nullable();
            $table->string('actstep4')->nullable();
            $table->string('crit4')->nullable();
            $table->string('tframe4')->nullable();
            $table->string('srba4')->nullable();
            $table->string('srbas4')->nullable();
            $table->string('nlct4')->nullable();
            $table->string('desc4')->nullable();
            $table->string('emgprot')->nullable();
            $table->string('compr')->nullable();
            $table->integer('psydrug')->nullable();
            $table->integer('pcp')->nullable();
            $table->integer('decline')->nullable();
            $table->integer('bh')->nullable();
            $table->string('bhtype')->nullable();
            $table->string('leadh')->nullable();
            $table->string('rbth')->nullable();
            $table->string('trh')->nullable();
            $table->string('bcbam')->nullable();
            $table->string('bcbatu')->nullable();
            $table->string('bcbawe')->nullable();
            $table->string('bcbath')->nullable();
            $table->string('bcbafri')->nullable();
            $table->string('rbtm')->nullable();
            $table->string('rbttu')->nullable();
            $table->string('rbtwe')->nullable();
            $table->string('rbtth')->nullable();
            $table->string('rbtfri')->nullable();
            $table->string('bacbname')->nullable();
            $table->string('bacbcer')->nullable();
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
        Schema::dropIfExists('sp_sixteen3_forms');
    }
}
