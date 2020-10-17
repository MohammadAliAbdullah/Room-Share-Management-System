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
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('writer_id')->unsigned();
            $table->foreign('writer_id')->references('id')->on('writers')->onDelete('cascade');
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
            $table->bigInteger('subcategory_id')->unsigned()->nullable();
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('restrict');
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('restrict');
            $table->bigInteger('state_id')->unsigned()->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('restrict');
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('restrict');
            $table->string('latitude',50);
            $table->string('longitude',50);
            $table->string('bedroom_count',10);
            $table->string('bed_count',10);
            $table->string('bathroom_count',10);
            $table->string('accomodates_count',10)->nullable();
            $table->tinyInteger('availability_type');
            $table->date('start_date')->nullable()->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('price',8,2);
            $table->tinyInteger('price_type')->nullable();
            $table->string('minimum_stay',5)->nullable();
            $table->tinyInteger('minimum_stay_type')->nullable();
            $table->tinyInteger('refund_type')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
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
