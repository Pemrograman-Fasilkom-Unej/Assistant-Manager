<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaskSubmissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('task_submissions', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('task_id')->index('task_submissions_ibfk_1');
			$table->string('nim', 15)->index('task_submissions_ibfk_2');
			$table->string('files', 191)->nullable();
			$table->text('comment', 65535)->nullable();
			$table->integer('score')->nullable();
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
		Schema::drop('task_submissions');
	}

}
