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
            $table->integer('weight');
            $table->integer('chest');
            $table->integer('biceps');
            $table->integer('stomach');
            $table->integer('waist');
            $table->integer('hip');
            $table->integer('thigh');
            $table->integer('calves');
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
