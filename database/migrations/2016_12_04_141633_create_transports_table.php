<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('transports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('purpose');
            $table->string('destination');
            $table->string('flight_no');
            $table->string('vehicle');
            $table->string('country');
            $table->integer('no_of_passengers');
            $table->integer('qty_goods');
            $table->date('departure_date');
            $table->time('departure_time');
            $table->date('return_date');
            $table->time('return_time');
            $table->string('type_of_service');
            $table->integer('user_id');
            $table->integer('department_id');
            $table->string('authorized');
            $table->string('approved');
            $table->string('driver');
            $table->float('perdiem');
            $table->float('vehicle_charge');
            $table->string('fuel_supply');
            $table->float('km_covered');
            $table->float('qty_fuel');
            $table->float('cost');
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
        Schema::drop('transports');
    }
}
