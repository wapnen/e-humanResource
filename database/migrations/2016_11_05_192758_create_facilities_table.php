<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('venue');
            $table->string('type');
            $table->integer('duration');
            $table->integer('user_id');
            $table->integer('department_id');
            $table->softDeletes();
            $table->string('submition_status')->default('Pending authorization');
            $table->string('approval_status')->default('Pending approval');
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
        Schema::drop('facilities');
    }
}
