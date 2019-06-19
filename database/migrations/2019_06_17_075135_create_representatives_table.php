<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepresentativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representatives', function (Blueprint $table) {
            $table->increments('rep_id');

            $table->unsignedInteger('rep_owner_id')->nullable();
            $table->foreign('rep_owner_id')->references('owners_id')->on('owners')->onDelete('cascade');

            $table->string('rep_name')->nullable();
            $table->string('rep_relationship')->nullable();
            $table->string('rep_mobile_number')->nullable();
            $table->timestamps();
        });

        \DB::statement('ALTER TABLE representatives AUTO_INCREMENT = 1000;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('representatives');
    }
}
