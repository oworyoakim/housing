<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount', 15, 2);
            $table->decimal('tax', 15, 2)->nullable();
            $table->decimal('discount', 15, 2)->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('email_address')->nullable();
            $table->string('phone');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
