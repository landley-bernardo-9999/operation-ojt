<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->increments('resident_id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('type_of_resident');
            $table->date('birthdate')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('ethnicity')->nullable();
            $table->string('id_info')->nullable();
            $table->string('email_address')->nullable()->unique();
            $table->string('mobile_number')->nullable()->unique();
            $table->string('telephone_number')->nullable();
            $table->string('house_number')->nullable();
            $table->string('barangay')->nullable();
            $table->string('municipality')->nullable();
            $table->string('province')->nullable();
            $table->string('zip')->nullable();
            $table->string('img')->nullable();
            $table->timestamps();
        });

        \DB::statement('ALTER TABLE residents AUTO_INCREMENT = 1000;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residents');
    }
}
