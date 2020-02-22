<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassAssistantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('class_assistants', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('assistant_id')->index('class_assistants_ibfk_1');
			$table->bigInteger('class_id')->index('class_assistants_ibfk_2');
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
		Schema::drop('class_assistants');
	}

}
