<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToStudentScoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('student_scores', function(Blueprint $table)
		{
			$table->foreign('nim', 'student_scores_ibfk_1')->references('nim')->on('students')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('score_id', 'student_scores_ibfk_2')->references('id')->on('scores')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('student_scores', function(Blueprint $table)
		{
			$table->dropForeign('student_scores_ibfk_1');
			$table->dropForeign('student_scores_ibfk_2');
		});
	}

}
