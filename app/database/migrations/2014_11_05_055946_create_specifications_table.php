<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpecificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('specifications', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('contractorid');
			$table->integer('clientid');
			$table->integer('projectid');
			$table->integer('jobtypeid');
			$table->integer('taskcategoryid');
			$table->integer('taskid');
			$table->string('jobtype_title');
			$table->string('taskcategory_title');
			$table->string('task_title');
			$table->double('estimate');
			$table->integer('qty');
			$table->double('cost_per_unit');
			$table->double('actual');
			$table->double('over_under');
			$table->double('subtotal');
			$table->longText('description')->nullable();
			$table->integer('ordering');
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
		Schema::drop('specifications');
	}

}
