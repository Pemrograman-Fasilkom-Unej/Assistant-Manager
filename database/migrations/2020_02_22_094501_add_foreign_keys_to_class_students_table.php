<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClassStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('class_students', function(Blueprint $table)
		{
			$table->foreign('class_id', 'class_students_ibfk_1')->references('id')->on('classes')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('class_students', function(Blueprint $table)
		{
			$table->dropForeign('class_students_ibfk_1');
		});
	}

}
