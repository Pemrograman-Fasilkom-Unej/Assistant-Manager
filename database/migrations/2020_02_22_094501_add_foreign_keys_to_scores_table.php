<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToScoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('scores', function(Blueprint $table)
		{
			$table->foreign('class_id', 'scores_ibfk_1')->references('id')->on('classes')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('task_id', 'scores_ibfk_2')->references('id')->on('tasks')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('scores', function(Blueprint $table)
		{
			$table->dropForeign('scores_ibfk_1');
			$table->dropForeign('scores_ibfk_2');
		});
	}

}
