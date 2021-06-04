<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomBedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_beds', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('bed_type_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('number_of_beds');
            $table->unique(['room_id', 'bed_type_id'],'room_bed_unique_3476388');
            $table->foreign('bed_type_id', 'bed_type_fk_3476385')->references('id')->on('bed_types');
            $table->foreign('room_id', 'room_fk_3476386')->references('id')->on('rooms');
            $table->foreign('user_id', 'user_fk_3476387')->references('id')->on('users');
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
        Schema::table('room_beds', function (Blueprint $table){
            $table->dropUnique('room_bed_unique_3476388');
            $table->dropConstrainedForeignId('bed_type_id');
            $table->dropConstrainedForeignId('room_id');
            $table->dropConstrainedForeignId('user_id');
        });
        Schema::dropIfExists('beds');
    }
}
