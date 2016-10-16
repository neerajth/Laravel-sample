<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('contractorid');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email')->nullable();
			$table->string('secondaryemail')->nullable();
			$table->string('phone');
			$table->string('secondaryphone')->nullable();
			$table->string('street1');
			$table->string('street2')->nullable();
			$table->string('city');
			$table->string('statecity');
			$table->string('zip')->nullable();
			$table->longText('client_note')->nullable();
			$table->string('second_firstname')->nullable();
			$table->string('second_lastname')->nullable();
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
		Schema::drop('clients');
	}

}
