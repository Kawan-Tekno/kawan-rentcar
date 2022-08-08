<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_cars', function (Blueprint $table) {
            $table->unsignedBigInteger('rest_request_id');
            $table->unsignedBigInteger('car_id')->comment('if car deleted change car_id to 99999999');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_cars');
    }
}
