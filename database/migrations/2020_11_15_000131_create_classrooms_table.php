<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id('classrooms_id'); 
            $table->string('classrooms');
            $table->string('numbers')->nullable();
            $table->string('seats')->nullable();
            $table->string('status')->default(0);
            $table->string('prohibit_Start')->nullable();
            $table->string('prohibit_End')->nullable();
            // $table->string('prohibit_days_start')->nullable();
            // $table->string('prohibit_days_end')->nullable();
            // $table->time('prohibit_time_start')->nullable();
            // $table->time('prohibit_time_end')->nullable();
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
        Schema::dropIfExists('classrooms');
    }
}
