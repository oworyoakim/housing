<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_amenities', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('amenity_id');
            $table->unsignedBigInteger('user_id');
            $table->unique(['room_id', 'amenity_id'], 'room_amenity_unique_23457');
            $table->foreign('room_id', 'room_fk_3476427')->references('id')->on('rooms');
            $table->foreign('amenity_id', 'amenity_fk_3476428')->references('id')->on('amenities');
            $table->foreign('user_id', 'user_fk_3476429')->references('id')->on('users');
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
        Schema::table('room_amenities', function (Blueprint $table){
            $table->dropUnique('room_amenity_unique_23457');
            $table->dropConstrainedForeignId('room_id');
            $table->dropConstrainedForeignId('amenity_id');
            $table->dropConstrainedForeignId('user_id');
        });
        Schema::dropIfExists('room_amenities');
    }
}
