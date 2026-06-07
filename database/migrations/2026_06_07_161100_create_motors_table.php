<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->string('type'); // e.g., Matic, Sport Bike, etc.
            $table->integer('price'); // price per day
            $table->string('image')->nullable();
            $table->string('fuel')->nullable(); // e.g. 5L, 4L
            $table->string('transmission')->nullable(); // e.g. Matic, Manual
            $table->string('status')->default('available'); // available, rented
            $table->text('desc')->nullable();
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
        Schema::dropIfExists('motors');
    }
}
