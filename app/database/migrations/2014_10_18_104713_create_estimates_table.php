<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstimatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estimates', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('file');
			$table->double('total');
			$table->integer('contractorid');
			$table->integer('projectid');
			$table->string('legend');
			$table->double('percentage');
			$table->string('proposal');
			$table->double('down_payment');
			$table->double('completion_foundation');
			$table->double('delivery_cabinets');
			$table->double('final_payment');
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
		Schema::drop('estimates');
	}

}
