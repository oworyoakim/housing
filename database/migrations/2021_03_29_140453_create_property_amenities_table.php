<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_amenities', function (Blueprint $table) {
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('amenity_id');
            $table->unsignedBigInteger('user_id');
            $table->unique(['property_id','amenity_id'], 'property_amenity_unique_23456');
            $table->foreign('property_id', 'property_fk_3476430')->references('id')->on('properties');
            $table->foreign('amenity_id', 'amenity_fk_3476431')->references('id')->on('amenities');
            $table->foreign('user_id', 'user_fk_3476432')->references('id')->on('users');
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
        Schema::table('property_amenities', function (Blueprint $table){
            $table->dropUnique('property_amenity_unique_23456');
            $table->dropConstrainedForeignId('property_id');
            $table->dropConstrainedForeignId('amenity_id');
            $table->dropConstrainedForeignId('user_id');
        });
        Schema::dropIfExists('property_amenities');
    }
}
