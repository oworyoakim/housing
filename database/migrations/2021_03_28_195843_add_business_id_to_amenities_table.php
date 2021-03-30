<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBusinessIdToAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amenities', function (Blueprint $table) {
            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id', 'amenity_business_fk')
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
        Schema::table('amenities', function (Blueprint $table) {
            $table->dropConstrainedForeignId('business_id');
        });
    }
}
