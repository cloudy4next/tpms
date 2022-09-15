<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->integer('is_active_client')->nullable();
            $table->string('client_gender_identity')->nullable();
            $table->string('client_relationship')->nullable();
            $table->string('client_employe_status')->nullable();
            $table->integer('race_ethnicity')->nullable();
            $table->string('race_ethnicity_details')->nullable();
            $table->string('preferred_language')->nullable();
            $table->text('client_notes')->nullable();
            $table->date('client_date_first_seen')->nullable();
            $table->string('client_reffered_by')->nullable();
            $table->string('relationship')->nullable();
            $table->string('asignment')->nullable();
            $table->integer('is_guarantor')->nullable();
            $table->text('signature_image')->nullable();
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
        Schema::dropIfExists('client_infos');
    }
}
