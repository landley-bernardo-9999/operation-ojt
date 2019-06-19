<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->increments('owner_id');
            $table->string('owner_first_name');
            $table->string('owner_middle_name')->nullable();
            $table->string('owner_last_name');
            $table->date('owner_birthdate')->nullable();
            $table->string('owner_gender')->nullable();
            $table->string('owner_nationality')->nullable();
            $table->string('owner_civil_status')->nullable();
            $table->string('owner_ethnicity')->nullable();
            $table->string('owner_id_info')->nullable();
            $table->string('owner_email_address')->nullable()->unique();
            $table->string('owner_mobile_number')->nullable()->unique();
            $table->string('owner_telephone_number')->nullable();
            $table->string('owner_house_number')->nullable();
            $table->string('owner_barangay')->nullable();
            $table->string('owner_municipality')->nullable();
            $table->string('owner_province')->nullable();
            $table->string('owner_zip')->nullable();
            $table->string('owner_img')->nullable();
            $table->timestamps();
        });

        \DB::statement('ALTER TABLE owners AUTO_INCREMENT = 1000;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('owners');
    }
}
