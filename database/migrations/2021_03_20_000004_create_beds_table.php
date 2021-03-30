<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bed_type_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('number_of_beds');
            $table->foreign('bed_type_id', 'bed_type_fk_3476385')->references('id')->on('bed_types');
            $table->foreign('room_id', 'room_fk_3476386')->references('id')->on('rooms');
            $table->foreign('user_id', 'user_fk_3476387')->references('id')->on('users');
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
        Schema::table('beds', function (Blueprint $table){
            $table->dropConstrainedForeignId('bed_type_id');
            $table->dropConstrainedForeignId('room_id');
            $table->dropConstrainedForeignId('user_id');
        });
        Schema::dropIfExists('beds');
    }
}
