<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment', function (Blueprint $table) {
            $table->id('assessment_id');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('assessment_form_id');
            $table->foreign('assessment_form_id')->references('assessment_form_id')->on('assessment_form')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references('question_id')->on('question')->onDelete('cascade')->onUpdate('cascade');
            $table->string('score');
            $table->string('suggestion')->nullable();
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
        Schema::dropIfExists('assessment');
    }
}
