<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_form', function (Blueprint $table) {
            $table->id('assessment_form_id');
            $table->unsignedBigInteger('semesters_id');
            $table->foreign('semesters_id')->references('semesters_id')->on('semesters')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('classrooms_id');
            $table->foreign('classrooms_id')->references('classrooms_id')->on('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status')->default(0);
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
        Schema::dropIfExists('assessment_form');
    }
}
