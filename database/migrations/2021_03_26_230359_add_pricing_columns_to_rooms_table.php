<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPricingColumnsToRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->after('property_id',function () use ($table){
                $table->float('rate', 15)->nullable();
                $table->enum('ratePeriod', [
                    \App\Models\Room::RATE_PERIOD_NIGHT,
                    \App\Models\Room::RATE_PERIOD_DAY,
                    \App\Models\Room::RATE_PERIOD_WEEK,
                    \App\Models\Room::RATE_PERIOD_MONTH,
                ])->default('night');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['rate','rate_period']);
        });
    }
}
