<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassDetailSoftwaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_detail_softwares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('classrooms_id');
            $table->foreign('classrooms_id')->references('classrooms_id')->on('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('softwares_id');
            $table->foreign('softwares_id')->references('softwares_id')->on('softwares')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('class_detail_softwares');
    }
}
