<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scores', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('class_id')->index('scores_ibfk_1');
			$table->boolean('type');
			$table->bigInteger('task_id')->index('scores_ibfk_2');
			$table->string('description', 191);
			$table->string('url', 191)->nullable();
			$table->integer('weight');
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
		Schema::drop('scores');
	}

}
