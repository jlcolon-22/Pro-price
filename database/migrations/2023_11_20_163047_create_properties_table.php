<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id()->from(000000001);
            $table->string('title');
            $table->string('price');
            $table->string('address');
            $table->string('land_size');
            $table->string('bed_room');
            $table->string('bath_room');
            $table->string('floor_number');
            $table->string('floor_area');
            $table->text('description');
            $table->boolean('status')->default(0)->nullable();
            $table->string('type');
            $table->unsignedBigInteger('seller_id');
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
        Schema::dropIfExists('properties');
    }
}
