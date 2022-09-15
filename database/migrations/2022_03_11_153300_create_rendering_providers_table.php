<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRenderingProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rendering_providers', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->string('provider_name')->nullable();
            $table->string('npi')->nullable();
            $table->string('upin')->nullable();
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
        Schema::dropIfExists('rendering_providers');
    }
}
