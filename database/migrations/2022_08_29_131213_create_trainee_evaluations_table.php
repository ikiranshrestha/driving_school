<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraineeEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainee_evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trainee_id');
            $table->foreign('trainee_id')->references('id')->on('trainees')->onDelete('cascade');
            $table->unsignedBigInteger('enroll_id');
            $table->foreign('enroll_id')->references('id')->on('enrollments')->onDelete('cascade');
            $table->integer('rounds');
            $table->integer('eight_boundary_violations');
            $table->integer('foot_on_ground');
            $table->integer('side_light_violation');
            $table->integer('traffic_light_violation');
            $table->integer('ramp_boundary_violation');
            $table->integer('engine_stoll');
            $table->integer('uphill_boundary_violation');
            $table->integer('downnhill_boundary_violation');
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
        Schema::dropIfExists('trainee_evaluations');
    }
}
