<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPricingColumnsToBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->float('listingPriceModifier', 15)->unsigned()->nullable();
            $table->string('listingCurrency')->nullable();
            $table->string('listingCurrencySymbol')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn(['listing_price_modifier', 'listing_currency', 'listing_currency_symbol']);
        });
    }
}
