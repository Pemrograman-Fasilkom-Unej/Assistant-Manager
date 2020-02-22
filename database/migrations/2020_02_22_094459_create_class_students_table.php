<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('class_students', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('class_id')->index('class_students_ibfk_1');
			$table->string('nim', 15)->index('nim');
			$table->string('grade', 5)->nullable();
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
		Schema::drop('class_students');
	}

}
