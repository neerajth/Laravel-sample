<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContractjobtypetaskcategoriesdefaultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contractjobtypetaskcategoriesdefaults', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('contractorid');
			$table->integer('taskcategoryid');
			$table->integer('jobtypeid');
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
		Schema::drop('contractjobtypetaskcategoriesdefaults');
	}

}
