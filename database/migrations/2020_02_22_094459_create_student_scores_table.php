<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentScoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_scores', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('score_id')->index('student_scores_ibfk_2');
			$table->string('nim', 15)->index('student_scores_ibfk_1');
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
		Schema::drop('student_scores');
	}

}
