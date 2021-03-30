<?php

use App\Models\Property;
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
            $table->id();
            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('street');
            $table->string('city');
            $table->string('country');
            $table->string('zip')->nullable();
            $table->enum('status',[
                Property::STATUS_PENDING,
                Property::STATUS_VERIFIED,
                Property::STATUS_BLOCKED
            ])->default('pending');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id', 'user_fk_3478971')
                  ->references('id')
                  ->on('users');
            $table->foreign('business_id', 'business_fk_3476371')
                  ->references('id')
                  ->on('businesses');
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
