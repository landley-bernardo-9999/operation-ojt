<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('contract_id');
            $table->date('enrollment_date');

            $table->unsignedInteger('contract_owner_id');
            $table->foreign('contract_owner_id')->references('owner_id')->on('owners')->onDelete('cascade');
            
            $table->unsignedInteger('contract_room_id');
            $table->foreign('contract_room_id')->references('room_id')->on('rooms')->onDelete('cascade');
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
        Schema::dropIfExists('contracts');
    }
}
