<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassDetailSupportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_detail_support', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('classrooms_id');
            $table->foreign('classrooms_id')->references('classrooms_id')->on('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('classrooms_support_id');
            $table->foreign('classrooms_support_id')->references('classrooms_support_id')->on('classrooms_support')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('class_detail_support');
    }
}
