<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_cheques', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('ammount');
            $table->integer('purchase_id');
            $table->string('reciept');
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
        Schema::drop('purchase_cheques');
    }
}
