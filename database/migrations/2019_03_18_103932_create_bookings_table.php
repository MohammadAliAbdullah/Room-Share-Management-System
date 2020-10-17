<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('room_id')->unsigned()->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade'); 
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('currency_id')->unsigned()->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->decimal('price_per_day',8,2);
            $table->decimal('price_for_stay',8,2);
            $table->decimal('tax_paid',8,2);
            $table->decimal('site_fees',8,2);
            $table->decimal('amount_paid',8,2);
            $table->dateTime('cancel_date')->nullable();
            $table->decimal('refund_paid',8,2)->nullable();
            $table->bigInteger('transaction_id')->unsigned()->nullable();
            //$table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
            $table->decimal('effective_amount',8,2);
            $table->dateTime('booking_date');
            $table->tinyInteger('approved')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
