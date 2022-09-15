<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_rules', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->string('rule_name')->nullable();
            $table->text('rule_description')->nullable();
            $table->integer('is_active')->nullable();
            $table->integer('prevent_session')->nullable();
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
        Schema::dropIfExists('service_rules');
    }
}
