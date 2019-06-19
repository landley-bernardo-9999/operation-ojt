<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('room_id');
            $table->string('room_no')->unique();
            $table->string('project');
            $table->string('building');
            $table->string('room_status');
            $table->double('short_term_rent', 15,8);
            $table->double('long_term_rent', 15, 8);
            $table->double('size', 15, 8);
            $table->string('no_of_beds');
            $table->longText('remarks')->nullable();
            $table->timestamps();
        });

        \DB::statement('ALTER TABLE rooms AUTO_INCREMENT = 1000;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
