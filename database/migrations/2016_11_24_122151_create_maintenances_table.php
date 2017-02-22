<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('facility_name');
            $table->string('location');
            $table->string('phone');
            $table->string('type');
            $table->string('subtype');
            $table->string('description');
            $table->integer('user_id');
            $table->integer('department_id');
            $table->string('submit_status')->default('Pending authorization');
            $table->string('approval_status')->default('Pending Confirmation');
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
        Schema::drop('maintenances');
    }
}
