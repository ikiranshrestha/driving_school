<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     //CREATE DATABASE drivingschool;
    public function up()
    {
        Schema::create('trainees', function (Blueprint $table) {
            $table->id();
            $table->string('t_fname');
            $table->string('t_lname');
            $table->string('t_mname');
            $table->string('t_uname');
            $table->string('t_secretkey');
            $table->date('t_dob');
            $table->string('t_email');
            $table->string('t_phone');
            $table->string('t_bloodgroup');
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainees');
    }
}
