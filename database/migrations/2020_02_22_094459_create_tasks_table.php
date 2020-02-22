<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('user_id')->index('tasks_ibfk_1');
			$table->bigInteger('class_id')->index('tasks_ibfk_2');
			$table->string('title', 191);
			$table->text('description', 65535);
			$table->string('url', 191)->nullable();
			$table->string('token', 32);
			$table->dateTime('due_time');
			$table->string('data_types', 191);
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
		Schema::drop('tasks');
	}

}
