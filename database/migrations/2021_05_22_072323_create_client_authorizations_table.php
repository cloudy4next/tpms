<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientAuthorizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_authorizations', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->string('authorization_name')->nullable();
            $table->integer('payor_id')->nullable();
            $table->string('treatment_type')->nullable();
            $table->integer('supervisor_id')->nullable();
            $table->string('description')->nullable();
            $table->date('onset_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('authorization_number')->nullable();
            $table->string('uci_id')->nullable();
            $table->string('cms_four')->nullable();
            $table->string('csm_eleven')->nullable();
            $table->string('diagnosis_one')->nullable();
            $table->string('diagnosis_two')->nullable();
            $table->string('diagnosis_three')->nullable();
            $table->string('diagnosis_four')->nullable();
            $table->string('deductible')->nullable();
            $table->integer('in_network')->nullable();
            $table->string('copay')->nullable();
            $table->string('max_total_auth')->nullable();
            $table->string('value')->nullable();
            $table->text('upload_authorization')->nullable();
            $table->text('notes')->nullable();
            $table->integer('is_primary')->nullable();
            $table->integer('is_placeholder')->nullable();
            $table->integer('is_valid')->nullable();
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
        Schema::dropIfExists('client_authorizations');
    }
}
