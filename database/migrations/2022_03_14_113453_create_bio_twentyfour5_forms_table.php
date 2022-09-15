<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBioTwentyfour5FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_twentyfour5_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->string('pres5')->nullable();
            $table->text('dailyliving')->nullable();
            $table->text('alltask')->nullable();
            $table->integer('technology')->nullable();
            $table->text('assisrequire')->nullable();
            $table->text('relationana')->nullable();
            $table->string('anxtxt')->nullable();
            $table->time('anxtime')->nullable();
            $table->string('pantxt')->nullable();
            $table->time('pantime')->nullable();
            $table->string('photxt')->nullable();
            $table->time('photime')->nullable();
            $table->string('obesstxt')->nullable();
            $table->time('obesstime')->nullable();
            $table->string('somatxt')->nullable();
            $table->time('somatime')->nullable();
            $table->string('deprtxt')->nullable();
            $table->time('deprtime')->nullable();
            $table->string('impatxt')->nullable();
            $table->time('impatime')->nullable();
            $table->string('poortxt')->nullable();
            $table->time('poortime')->nullable();
            $table->string('inttxt')->nullable();
            $table->time('inttime')->nullable();
            $table->string('dystxt')->nullable();
            $table->time('dystime')->nullable();
            $table->string('weighttxt')->nullable();
            $table->time('weighttime')->nullable();
            $table->string('bizarrtxt')->nullable();
            $table->time('bizarrtime')->nullable();
            $table->string('bbtxt')->nullable();
            $table->time('bbtime')->nullable();
            $table->string('pitxt')->nullable();
            $table->time('pitime')->nullable();
            $table->string('pjtxt')->nullable();
            $table->time('pjtime')->nullable();
            $table->string('pistxt')->nullable();
            $table->time('pistime')->nullable();
            $table->string('cptxt')->nullable();
            $table->time('cptime')->nullable();
            $table->string('sptxt')->nullable();
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
        Schema::dropIfExists('bio_twentyfour5_forms');
    }
}
