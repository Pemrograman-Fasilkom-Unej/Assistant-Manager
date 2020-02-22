<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserConfigsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_configs', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('user_id')->index('user_configs_ibfk_1');
			$table->boolean('dark_theme')->default(0);
			$table->boolean('collapse_sidebar')->default(0);
			$table->boolean('fixed_header')->default(1);
			$table->string('logo_background', 191)->default('skin6');
			$table->string('navbar_background', 191)->default('skin1');
			$table->string('sidebar_background', 191)->default('skin6');
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
		Schema::drop('user_configs');
	}

}
