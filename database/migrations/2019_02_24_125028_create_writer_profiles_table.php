<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWriterProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('writer_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('writer_id')->unsigned();
            $table->foreign('writer_id')->references('id')->on('writers')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('nid');
            $table->string('phone')->unique();
            $table->string('school');
            $table->string('work');
            $table->string('languages');
            $table->string('image');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('writer_profiles');
    }
}
