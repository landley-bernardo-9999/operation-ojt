<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuardiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->increments('guardian_id');

            $table->unsignedInteger('guardian_resident_id')->nullable();
            $table->foreign('guardian_resident_id')->references('residents_id')->on('residents')->onDelete('cascade');

            $table->string('name')->nullable();
            $table->string('relationship')->nullable();
            $table->string('mobile_number')->nullable();
            $table->timestamps();
        });

        \DB::statement('ALTER TABLE guardians AUTO_INCREMENT = 1000;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guardians');
    }
}
