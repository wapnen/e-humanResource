<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('health_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('patient_name');
            $table->string('folder_no');
            $table->string('account_type');
            $table->string('account_code');
            $table->string('user_id');
            $table->float('total');
            $table->string('deducted')->default('Not deducted');
            $table->string('recieved')->default('Not recieved');
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
        Schema::drop('health_charges');
    }
}
