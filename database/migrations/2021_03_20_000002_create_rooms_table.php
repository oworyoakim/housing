<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->boolean('published')->default(false);
            $table->unsignedBigInteger('user_id');
            $table->unsignedSmallInteger('frequency')->default(1);
            $table->unsignedSmallInteger('bathrooms')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id', 'user_fk_3476371')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table){
            $table->dropConstrainedForeignId('user_id');
        });
        Schema::dropIfExists('rooms');
    }
}
