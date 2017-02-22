<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('days_entitled');
            $table->integer('outstanding_leave');
            $table->integer('days_taken');
            $table->integer('leave_due');
            $table->integer('days_approved');
            $table->date('from');
            $table->date('to');
            $table->string('phone');
            $table->date('resumption_date');
            $table->float('money_entitled');
            $table->string('leave_contact');
            $table->integer('user_id');
            $table->integer('department_id');
            $table->string('contact_name');
            $table->string('address');
            $table->string('authorized')->default('pending');
            $table->string('approved')->default('pending');
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
        Schema::drop('leaves');
    }
}
