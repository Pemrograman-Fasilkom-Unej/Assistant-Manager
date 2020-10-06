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
            $table->id();
            $table->string('title');
            $table->string('slug')->comment('title + year + season');
            $table->tinyInteger('season')->comment('1: Odd, 2: Even');
            $table->integer('year');
            $table->integer('class_day');
            $table->time('class_time');
            $table->boolean('status')->comment('1: Active, 0: Inactive');

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
