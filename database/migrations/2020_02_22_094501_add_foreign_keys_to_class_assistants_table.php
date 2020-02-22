<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClassAssistantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('class_assistants', function(Blueprint $table)
		{
			$table->foreign('assistant_id', 'class_assistants_ibfk_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('class_id', 'class_assistants_ibfk_2')->references('id')->on('classes')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('class_assistants', function(Blueprint $table)
		{
			$table->dropForeign('class_assistants_ibfk_1');
			$table->dropForeign('class_assistants_ibfk_2');
		});
	}

}
