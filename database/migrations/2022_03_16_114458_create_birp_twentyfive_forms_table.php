<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBirpTwentyfiveFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('birp_twentyfive_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->integer('consumer')->nullable();
            $table->integer('pother')->nullable();
            $table->integer('pparent')->nullable();
            $table->integer('parent')->nullable();
            $table->integer('pgaurdian')->nullable();
            $table->integer('affect')->nullable();
            $table->string('proselect')->nullable();
            $table->string('newselect')->nullable();
            $table->integer('contacttype')->nullable();
            $table->integer('stressor')->nullable();
            $table->text('stressexp')->nullable();
            $table->text('stresscomm')->nullable();
            $table->integer('imi')->nullable();
            $table->string('goalselect')->nullable();
            $table->string('objselect')->nullable();
            $table->string('intselect')->nullable();
            $table->text('nonbill')->nullable();
            $table->text('enc1')->nullable();
            $table->text('formul1')->nullable();
            $table->text('ass1')->nullable();
            $table->text('reminded1')->nullable();
            $table->text('urged1')->nullable();
            $table->text('refer1')->nullable();
            $table->text('engage1')->nullable();
            $table->text('confirm1')->nullable();
            $table->text('resp1')->nullable();
            $table->text('direct1')->nullable();
            $table->text('arr1')->nullable();
            $table->text('assur1')->nullable();
            $table->text('resch1')->nullable();
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
        Schema::dropIfExists('birp_twentyfive_forms');
    }
}
