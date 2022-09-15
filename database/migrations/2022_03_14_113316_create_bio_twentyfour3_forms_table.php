<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBioTwentyfour3FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_twentyfour3_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->integer('affcrit')->nullable();
            $table->integer('affflat')->nullable();
            $table->integer('affangr')->nullable();
            $table->integer('affeuph')->nullable();
            $table->integer('affsilly')->nullable();
            $table->integer('affirri')->nullable();
            $table->integer('affdepr')->nullable();
            $table->integer('affhope')->nullable();
            $table->integer('depnone')->nullable();
            $table->integer('dephypo')->nullable();
            $table->integer('depfati')->nullable();
            $table->integer('depfee')->nullable();
            $table->integer('depguilt')->nullable();
            $table->integer('dephelpless')->nullable();
            $table->integer('depirrit')->nullable();
            $table->integer('deppoor')->nullable();
            $table->integer('depsadn')->nullable();
            $table->integer('depsexual')->nullable();
            $table->integer('deploss')->nullable();
            $table->integer('depwithdraw')->nullable();
            $table->integer('depself')->nullable();
            $table->integer('depinter')->nullable();
            $table->integer('depcry')->nullable();
            $table->text('deprcomm')->nullable();
            $table->integer('thinun')->nullable();
            $table->integer('thindiss')->nullable();
            $table->integer('thindel')->nullable();
            $table->integer('thinhyp')->nullable();
            $table->integer('thindis')->nullable();
            $table->integer('thinsus')->nullable();
            $table->integer('thinobs')->nullable();
            $table->integer('thinfli')->nullable();
            $table->integer('thinconf')->nullable();
            $table->integer('thingrand')->nullable();
            $table->text('thinkcomm')->nullable();
            $table->integer('attun')->nullable();
            $table->integer('attego')->nullable();
            $table->integer('attsar')->nullable();
            $table->integer('attres')->nullable();
            $table->integer('attcont')->nullable();
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
        Schema::dropIfExists('bio_twentyfour3_forms');
    }
}
