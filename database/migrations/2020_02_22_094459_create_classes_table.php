<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classes', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('title', 191);
			$table->integer('semester');
			$table->integer('year');
			$table->integer('day');
			$table->time('time');
			$table->boolean('status')->nullable()->default(1)->comment('0 : inactive, 1 : active');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('classes');
	}

}
