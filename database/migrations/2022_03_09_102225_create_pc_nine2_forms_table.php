<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcNine2FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_nine2_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('sessionid')->nullable();
            $table->integer('repth')->nullable();
            $table->integer('repbeh')->nullable();
            $table->integer('homith')->nullable();
            $table->integer('suiattm')->nullable();
            $table->string('suiwhen')->nullable();
            $table->integer('curremp')->nullable();
            $table->string('emppos')->nullable();
            $table->string('emphappy')->nullable();
            $table->text('workstress')->nullable();
            $table->integer('religious')->nullable();
            $table->string('faith')->nullable();
            $table->integer('spiritual')->nullable();
            $table->integer('difficulty')->nullable();
            $table->integer('depr')->nullable();
            $table->string('depexp')->nullable();
            $table->integer('bipdis')->nullable();
            $table->string('bipdisexp')->nullable();
            $table->integer('anxdis')->nullable();
            $table->integer('anxdisexp')->nullable();
            $table->integer('panicatt')->nullable();
            $table->string('panicattexp')->nullable();
            $table->integer('sch')->nullable();
            $table->string('schexp')->nullable();
            $table->integer('abuse')->nullable();
            $table->string('abusexp')->nullable();
            $table->integer('eatdis')->nullable();
            $table->string('eatdisexp')->nullable();
            $table->integer('leardis')->nullable();
            $table->string('leardisexp')->nullable();
            $table->integer('trauma')->nullable();
            $table->string('traumaexp')->nullable();
            $table->integer('suiatt')->nullable();
            $table->string('suiattexp')->nullable();
            $table->integer('chrill')->nullable();
            $table->string('chrillexp')->nullable();
            $table->text('strength')->nullable();
            $table->text('aboutyou')->nullable();
            $table->text('copstra')->nullable();
            $table->text('goalthe')->nullable();
            $table->integer('diagassess')->nullable();
            $table->integer('nurse')->nullable();
            $table->integer('psytest')->nullable();
            $table->integer('psytreat')->nullable();
            $table->integer('medadmin')->nullable();
            $table->integer('commsupport')->nullable();
            $table->integer('indout')->nullable();
            $table->integer('outser')->nullable();
            $table->integer('groupout')->nullable();
            $table->integer('intenfam')->nullable();
            $table->integer('stab')->nullable();
            $table->integer('struct')->nullable();
            $table->integer('psyassess')->nullable();
            $table->integer('behass')->nullable();
            $table->integer('otherr')->nullable();
            $table->integer('otherr2')->nullable();
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
        Schema::dropIfExists('pc_nine2_forms');
    }
}
