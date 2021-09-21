<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('e_aid');
            $table->unsignedBigInteger('e_cid');
            $table->unsignedBigInteger('e_pid');
            $table->date('e_startdate');
            $table->unsignedBigInteger('e_tmid');

            $table->foreign('e_aid')->references('id')->on('admissions')->onDelete('cascade');
            $table->foreign('e_cid')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('e_pid')->references('id')->on('coursepackages')->onDelete('cascade');
            $table->foreign('e_tmid')->references('id')->on('time')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
}
