<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charges', function (Blueprint $table) {
            $table->bigIncrements('charge_id');

            $table->unsignedInteger('charge_trans_id');
            $table->foreign('charge_trans_id')->references('transaction_id')->on('transactions')->onDelete('cascade');

            $table->string('item');
            $table->double('amt', 15, 2);
            $table->integer('qty');
            $table->double('total_amt', 15, 2);
            $table->timestamps();
        });


        \DB::statement('ALTER TABLE charges AUTO_INCREMENT = 1000;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charges');
    }
}
