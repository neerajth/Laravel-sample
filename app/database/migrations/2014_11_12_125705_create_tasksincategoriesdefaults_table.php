<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTasksincategoriesdefaultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasksincategoriesdefaults', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('taskcategoryid');
			$table->integer('contractorid');
			$table->integer('taskid');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tasksincategoriesdefaults');
	}

}
