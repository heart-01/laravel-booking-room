<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassDetailImgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_detail_img', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('classrooms_id');
            $table->foreign('classrooms_id')->references('classrooms_id')->on('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->string('image');
            $table->boolean('preview')->nullable();
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
        Schema::dropIfExists('class_detail_img');
    }
}
