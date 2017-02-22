<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        Schema::create('foods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone');
            $table->string('purpose');
            $table->date('delivery_date');
            $table->time('delivery_time');
            $table->integer('people');
            $table->float('ammount_charged')->default(0.00);
            $table->string('submit_status')->default('Pending authorization');
            $table->string('approval_status')->default('Pending approval');
            $table->string('confirmation')->default('Pending confirmation');
            $table->integer('user_id');
            $table->integer('department_id');
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
        Schema::drop('foods');
    }
}
