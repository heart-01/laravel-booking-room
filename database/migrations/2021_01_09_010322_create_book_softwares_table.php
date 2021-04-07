<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookSoftwaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_softwares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bookings_id');
            $table->foreign('bookings_id')->references('bookings_id')->on('bookings')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('softwares_id')->nullable();
            $table->foreign('softwares_id')->references('softwares_id')->on('softwares')->onDelete('cascade')->onUpdate('cascade');
            $table->string('otherSofware')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_softwares');
    }
}
