<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('bookings_id');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('classrooms_id');
            $table->foreign('classrooms_id')->references('classrooms_id')->on('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('semesters_id');
            $table->foreign('semesters_id')->references('semesters_id')->on('semesters')->onDelete('cascade')->onUpdate('cascade');
            $table->string('days');
            $table->time('time_start');
            $table->time('time_end');
            $table->string('seats');
            $table->string('fname');
            $table->string('lname');
            $table->string('email');
            $table->string('tel');
            $table->string('faculty');
            $table->string('subject');
            $table->string('course_code');
            $table->string('part');
            $table->string('status');
            $table->unsignedBigInteger('approval')->nullable();
            $table->foreign('approval')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('bookings');
    }
}
