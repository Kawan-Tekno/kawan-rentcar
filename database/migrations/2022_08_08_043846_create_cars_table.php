<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_type_id');
            $table->string('plat_no')->unique();
            $table->integer('year');
            $table->enum('condition', ['Good', 'Need fix', 'On repairing', 'Other'])->comment('Good, Need fix, On repairing, Other');
            $table->text('description')->nullable();
            $table->boolean('avaliable');
            $table->integer('price_per_period')->comment('Period is like day, 6hours. So something like 500k per day.');
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
        Schema::dropIfExists('cars');
    }
}
