<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBioTwentyfour2FormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_twentyfour2_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('sessionid');
            $table->integer('sdativ')->nullable();
            $table->integer('barbit')->nullable();
            $table->integer('methad')->nullable();
            $table->integer('subother')->nullable();
            $table->integer('tobacco')->nullable();
            $table->integer('alcohol')->nullable();
            $table->integer('mariju')->nullable();
            $table->integer('tranqu')->nullable();
            $table->integer('metham')->nullable();
            $table->integer('overcount')->nullable();
            $table->integer('inhalant')->nullable();
            $table->integer('stimul')->nullable();
            $table->integer('cocain')->nullable();
            $table->text('withdrawal')->nullable();
            $table->text('askandrecord')->nullable();
            $table->text('sobriety')->nullable();
            $table->text('whensobriety')->nullable();
            $table->integer('unremark')->nullable();
            $table->integer('unkempt')->nullable();
            $table->integer('atypical')->nullable();
            $table->integer('person')->nullable();
            $table->integer('place')->nullable();
            $table->integer('oridate')->nullable();
            $table->integer('situation')->nullable();
            $table->integer('insightpoor')->nullable();
            $table->integer('insightaverage')->nullable();
            $table->integer('insightgood')->nullable();
            $table->integer('judgpoor')->nullable();
            $table->integer('judgaver')->nullable();
            $table->integer('judggood')->nullable();
            $table->text('judgecomment')->nullable();
            $table->integer('motorun')->nullable();
            $table->integer('motorrest')->nullable();
            $table->integer('motorwith')->nullable();
            $table->integer('motorslurr')->nullable();
            $table->integer('limit')->nullable();
            $table->text('sleeppat')->nullable();
            $table->text('appetite')->nullable();
            $table->text('acomment')->nullable();
            $table->integer('affun')->nullable();
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
        Schema::dropIfExists('bio_twentyfour2_forms');
    }
}
