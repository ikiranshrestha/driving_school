<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursepackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coursepackages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('p_cid');
            $table->string('p_name');
            $table->integer('p_duration');
            $table->double('p_cost');

            $table->foreign('p_cid')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coursepackages');
    }
}
