<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTaskSubmissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('task_submissions', function(Blueprint $table)
		{
			$table->foreign('task_id', 'task_submissions_ibfk_1')->references('id')->on('tasks')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('nim', 'task_submissions_ibfk_2')->references('nim')->on('students')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('task_submissions', function(Blueprint $table)
		{
			$table->dropForeign('task_submissions_ibfk_1');
			$table->dropForeign('task_submissions_ibfk_2');
		});
	}

}
