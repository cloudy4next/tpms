<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScrubbingRulesAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scrubbing_rules_assigns', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('rule_id');
            $table->integer('payer_id');
            $table->integer('run');
            $table->integer('prevent');
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
        Schema::dropIfExists('scrubbing_rules_assigns');
    }
}
