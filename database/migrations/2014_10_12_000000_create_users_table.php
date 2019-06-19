<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('privilege');

            $table->unsignedInteger('user_resident_id')->nullable();
            $table->foreign('user_resident_id')->references('resident_id')->on('residents')->onDelete('cascade');

            $table->unsignedInteger('user_owner_id')->nullable();
            $table->foreign('user_owner_id')->references('owner_id')->on('owners')->onDelete('cascade');

            $table->rememberToken();
            $table->timestamps();
        });

        \DB::statement('ALTER TABLE users AUTO_INCREMENT = 1000;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
