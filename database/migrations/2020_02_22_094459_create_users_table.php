<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('name', 191);
			$table->string('username', 191);
			$table->string('nim', 15)->nullable();
			$table->string('email', 191);
			$table->string('avatar', 191)->nullable();
			$table->string('password', 191);
			$table->bigInteger('role_id')->index('role_id');
			$table->string('token', 32)->nullable();
			$table->string('remember_token', 191)->nullable();
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
		Schema::drop('users');
	}

}
