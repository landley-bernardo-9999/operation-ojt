<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('payment_id');

            $table->unsignedInteger('payment_transaction_id');
            $table->foreign('payment_transaction_id')->references('transaction_id')->on('transactions')->onDelete('cascade');

            $table->string('desc')->nullable();
            $table->integer('amt')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('or_number')->nullable();
            $table->string('ar_number')->nullable();
            $table->string('form_of_payment')->nullable();
            $table->string('check_no')->nullable();
            $table->string('date_deposited')->nullable();
            $table->string('bank_name')->nullable();
            $table->integer('amt_paid')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });

        \DB::statement('ALTER TABLE payments AUTO_INCREMENT = 1000;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
