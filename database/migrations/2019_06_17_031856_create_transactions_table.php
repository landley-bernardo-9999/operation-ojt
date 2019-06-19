<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('trans_id');
            $table->date('trans_date');

            $table->unsignedInteger('trans_room_id');
            $table->foreign('trans_room_id')->references('room_id')->on('rooms')->onDelete('cascade');

            $table->unsignedInteger('trans_resident_id');
            $table->foreign('trans_resident_id')->references('resident_id')->on('residents')->onDelete('cascade');

            $table->unsignedInteger('trans_owner_id');
            $table->foreign('trans_owner_id')->references('owner_id')->on('owners')->onDelete('cascade');

            $table->string('trans_status');
            $table->date('actual_move_out_date')->nullable();
            $table->string('move_out_reason')->nullable();
            $table->date('move_in_date');
            $table->date('move_out_date');
            $table->string('term');

            $table->integer('initial_water_reading')->nullable();
            $table->integer('initial_electric_reading')->nullable();
            $table->integer('final_water_reading')->nullable();
            $table->integer('final_electric_reading')->nullable();
      
            $table->timestamps();
        });

        \DB::statement('ALTER TABLE transactions AUTO_INCREMENT = 1000;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
